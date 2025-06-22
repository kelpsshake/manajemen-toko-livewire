<?php

namespace App\Livewire\Laporan;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $tanggal;

    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d'); // default hari ini
    }

    public function render()
    {
        // Ambil total penjualan hari ini
        $penjualanHariIni = Penjualan::whereDate('tanggal', $this->tanggal)
            ->join('produks', 'penjualans.produk_id', '=', 'produks.id')
            ->select(DB::raw('SUM(penjualans.jumlah * produks.harga) as total_penjualan'))
            ->value('total_penjualan') ?? 0;

        $stokProduk = Produk::orderBy('nama_produk')->get();

        return view('livewire.laporan.index', [
            'penjualanHariIni' => $penjualanHariIni,
            'produkList' => $stokProduk,
        ]);
    }
}
