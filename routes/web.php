<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Produk\{Index as ProdukIndex, Create as ProdukCreate, Edit as ProdukEdit};
use App\Livewire\Kategori\{Index as KategoriIndex, Create as KategoriCreate, Edit as KategoriEdit};
use App\Livewire\Supplier\{Index as SupplierIndex, Create as SupplierCreate, Edit as SupplierEdit};
use App\Livewire\Penjualan\{Index as PenjualanIndex, Create as PenjualanCreate};
use App\Livewire\Laporan\Index as LaporanIndex;

Route::view('/', 'welcome')->name('home');

// Semua route berikut hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    // Produk
    Route::get('/produk', ProdukIndex::class)->name('produk.index');
    Route::get('/produk/create', ProdukCreate::class)->name('produk.create');
    Route::get('/produk/{id}/edit', ProdukEdit::class)->name('produk.edit');

    // Kategori
    Route::get('/kategori', KategoriIndex::class)->name('kategori.index');
    Route::get('/kategori/create', KategoriCreate::class)->name('kategori.create');
    Route::get('/kategori/{id}/edit', KategoriEdit::class)->name('kategori.edit');

    // Supplier
    Route::get('/supplier', SupplierIndex::class)->name('supplier.index');
    Route::get('/supplier/create', SupplierCreate::class)->name('supplier.create');
    Route::get('/supplier/{id}/edit', SupplierEdit::class)->name('supplier.edit');

    // Penjualan
    Route::get('/penjualan/create', PenjualanCreate::class)->name('penjualan.create');

    // Laporan
    Route::get('/laporan', LaporanIndex::class)->name('laporan.index');

    // Profile (dummy route)
    Route::view('/profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
