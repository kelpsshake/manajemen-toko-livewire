<x-app-layout>

    <div>
        <h1>🏪 Dashboard Manajemen Toko</h1>
        <p class="text-muted">Selamat datang di sistem manajemen produk toko</p>

        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>📁 Kategori</h5>
                        <h2>{{ $totalKategori }}</h2> 
                        <small>Total kategori</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>🏢 Supplier</h5>
                        <h2>{{ $totalSupplier }}</h2>  
                        <small>Total supplier</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>📦 Produk</h5>
                        <h2>{{ $totalProduk }}</h2>       
                        <small>Total produk</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>💰 Penjualan</h5>
                        <h2>Rp {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</h2> 
                        <small>Total penjualan hari ini</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-info mt-4">
            <h5>📝 Langkah Selanjutnya:</h5>
            <ol>
                <li>Tambahkan kategori produk</li>
                <li>Tambahkan data supplier</li>
                <li>Tambahkan produk</li>
                <li>Mulai transaksi penjualan</li>
            </ol>
        </div>
    </div>
</x-app-layout>
