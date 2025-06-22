<?php

namespace App\Livewire\Dashboard;

use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Produk;
use App\Models\Penjualan;
use Livewire\Component;

class Index extends Component
{
    public $totalKategori, $totalSupplier, $totalProduk, $totalPenjualanHariIni;

    public function mount()
    {
        $this->totalKategori = Kategori::count();
        $this->totalSupplier = Supplier::count();
        $this->totalProduk = Produk::count();

        $this->totalPenjualanHariIni = Penjualan::whereDate('tanggal', now())
            ->join('produks', 'penjualans.produk_id', '=', 'produks.id')
            ->selectRaw('SUM(penjualans.jumlah * produks.harga) as total')
            ->value('total') ?? 0;
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
