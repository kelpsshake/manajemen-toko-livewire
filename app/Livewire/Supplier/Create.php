<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $nama_supplier, $alamat, $telepon;

    protected $rules = [
        'nama_supplier' => 'required|min:3|max:100|unique:suppliers,nama_supplier',
        'alamat'        => 'required|min:5|max:255',
        'telepon'       => 'required|min:10|max:15'
    ];

    protected $messages = [
        'nama_supplier.required' => 'Nama supplier wajib diisi.',
        'nama_supplier.min'      => 'Minimal 3 karakter.',
        'nama_supplier.max'      => 'Maksimal 100 karakter.',
        'nama_supplier.unique'   => 'Nama supplier sudah ada.',
        'alamat.required'        => 'Alamat wajib diisi.',
        'telepon.required'       => 'Nomor telepon wajib diisi.'
    ];

    public function store()
    {
        $this->validate();

        Supplier::create([
            'nama_supplier' => $this->nama_supplier,
            'alamat'        => $this->alamat,
            'telepon'       => $this->telepon
        ]);

        session()->flash('success', 'Supplier berhasil ditambahkan!');
        return $this->redirectRoute('supplier.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.supplier.create');
    }
}
