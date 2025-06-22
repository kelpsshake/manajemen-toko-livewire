<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public $supplier_id;
    public $nama_supplier, $alamat, $telepon;

    protected $rules = [
        'nama_supplier' => 'required|min:3|max:100',
        'alamat'        => 'required|min:5|max:255',
        'telepon'       => 'required|min:10|max:15'
    ];

    protected $messages = [
        'nama_supplier.required' => 'Nama supplier wajib diisi.',
        'nama_supplier.min'      => 'Minimal 3 karakter.',
        'nama_supplier.max'      => 'Maksimal 100 karakter.',
        'alamat.required'        => 'Alamat wajib diisi.',
        'telepon.required'       => 'Nomor telepon wajib diisi.'
    ];

    public function mount($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplier_id   = $supplier->id;
        $this->nama_supplier = $supplier->nama_supplier;
        $this->alamat        = $supplier->alamat;
        $this->telepon       = $supplier->telepon;
    }

    public function update()
    {
        $this->validate([
            'nama_supplier' => 'required|min:3|max:100|unique:suppliers,nama_supplier,' . $this->supplier_id,
            'alamat'        => 'required|min:5|max:255',
            'telepon'       => 'required|min:10|max:15'
        ]);

        Supplier::findOrFail($this->supplier_id)->update([
            'nama_supplier' => $this->nama_supplier,
            'alamat'        => $this->alamat,
            'telepon'       => $this->telepon
        ]);

        session()->flash('success', 'Supplier berhasil diperbarui!');
        return $this->redirectRoute('supplier.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.supplier.edit');
    }
}
