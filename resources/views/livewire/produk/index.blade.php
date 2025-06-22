@section('title', 'Data Produk')

<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Produk</h5>
                    <a class="btn btn-primary" href="{{ route('produk.create') }}" wire:navigate>
                        <i class="fas fa-plus"></i> Tambah Produk
                    </a>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Filter & Search -->
                    <div class="row mb-3">
                        <div class="col-md-4 mb-2">
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control" placeholder="Cari nama produk...">
                        </div>
                        <div class="col-md-4 mb-2">
                            <select class="form-select" wire:model="filterKategori">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <select class="form-select" wire:model="filterSupplier">
                                <option value="">Semua Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>
                                        <a href="#" wire:click.prevent="sortBy('nama_produk')" class="text-white text-decoration-none">
                                            Nama Produk
                                            @if ($sortField === 'nama_produk')
                                                @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th>Supplier</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produks as $produk)
                                    <tr>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                                        <td>{{ $produk->supplier->nama_supplier ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('produk.edit', $produk->id) }}" 
                                               class="btn btn-sm btn-warning" wire:navigate>Edit</a>
                                            <button wire:click="destroy({{ $produk->id }})"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin hapus produk ini?')">
                                                    Delete
                                            </button>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-info mb-0">Data produk belum tersedia</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $produks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
