@section('title', 'Laporan Penjualan & Stok')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Laporan Harian</h5>
                <input type="date" wire:model="tanggal" class="form-control w-auto" />
            </div>
            <div class="card-body">
                <h5>Total Penjualan: <strong>Rp{{ number_format($penjualanHariIni, 0, ',', '.') }}</strong></h5>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Stok Produk Tersisa</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkList as $produk)
                                <tr>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>{{ $produk->stok }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <div class="alert alert-info mb-0">Belum ada data produk.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
