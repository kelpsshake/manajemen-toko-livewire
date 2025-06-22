<?php

namespace App\Livewire\Penjualan;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\StokLog;
use Livewire\Component;

class Create extends Component
{
    public $produk_id, $jumlah;
    public $produkList = [];

    public function mount()
    {
        $this->produkList = Produk::orderBy('nama_produk')->get();
    }

    public function store()
    {
        $this->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah'    => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($this->produk_id);

        if ($produk->stok < $this->jumlah) {
            session()->flash('error', 'Stok tidak mencukupi!');
            return;
        }

        Penjualan::create([
    'produk_id'   => $this->produk_id,
    'jumlah'      => $this->jumlah,
    'tanggal'     => now(),
    'total_harga' => $this->jumlah * $produk->harga,
]);


        $produk->decrement('stok', $this->jumlah);

        StokLog::create([
            'produk_id' => $this->produk_id,
            'jenis'     => 'keluar',
            'jumlah'    => $this->jumlah,
            'tanggal'   => now(),
        ]);

        session()->flash('success', 'Penjualan berhasil disimpan!');
        $this->reset(['produk_id', 'jumlah']);
    }

    public function render()
    {
        return view('livewire.penjualan.create');
    }
}
