<?php

namespace App\Livewire\Produk;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $nama_produk, $harga, $stok, $kategori_id, $supplier_id;
    public $kategoris, $suppliers;

    protected $rules = [
        'nama_produk' => 'required|min:3|max:100|unique:produks,nama_produk',
        'harga'       => 'required|numeric|min:1',
        'stok'        => 'required|integer|min:0',
        'kategori_id' => 'required|exists:kategoris,id',
        'supplier_id' => 'required|exists:suppliers,id'
    ];

    public function mount()
    {
        $this->kategoris = Kategori::all();
        $this->suppliers = Supplier::all();
    }

    public function store()
    {
        $this->validate();

        Produk::create([
            'nama_produk' => $this->nama_produk,
            'harga'       => $this->harga,
            'stok'        => $this->stok,
            'kategori_id' => $this->kategori_id,
            'supplier_id' => $this->supplier_id
        ]);

        session()->flash('success', 'Produk berhasil ditambahkan!');
        return $this->redirectRoute('produk.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.produk.create');
    }
}
