<?php

namespace App\Livewire\Produk;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public $produk_id;
    public $nama_produk, $harga, $stok, $kategori_id, $supplier_id;
    public $kategoris, $suppliers;

    protected $rules = [
        'nama_produk' => 'required|min:3|max:100',
        'harga'       => 'required|numeric|min:1',
        'stok'        => 'required|integer|min:0',
        'kategori_id' => 'required|exists:kategoris,id',
        'supplier_id' => 'required|exists:suppliers,id'
    ];

    public function mount($id)
    {
        $produk = Produk::findOrFail($id);

        $this->produk_id     = $produk->id;
        $this->nama_produk   = $produk->nama_produk;
        $this->harga         = $produk->harga;
        $this->stok          = $produk->stok;
        $this->kategori_id   = $produk->kategori_id;
        $this->supplier_id   = $produk->supplier_id;

        $this->kategoris     = Kategori::all();
        $this->suppliers     = Supplier::all();
    }

    public function update()
    {
        $this->validate([
            'nama_produk' => 'required|min:3|max:100|unique:produks,nama_produk,' . $this->produk_id,
            'harga'       => 'required|numeric|min:1',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'supplier_id' => 'required|exists:suppliers,id'
        ]);

        Produk::findOrFail($this->produk_id)->update([
            'nama_produk' => $this->nama_produk,
            'harga'       => $this->harga,
            'stok'        => $this->stok,
            'kategori_id' => $this->kategori_id,
            'supplier_id' => $this->supplier_id,
        ]);

        session()->flash('success', 'Produk berhasil diperbarui!');
        return $this->redirectRoute('produk.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.produk.edit');
    }
}
