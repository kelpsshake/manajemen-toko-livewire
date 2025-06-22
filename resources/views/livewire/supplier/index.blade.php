@section('title', 'Data Supplier')

<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Supplier</h5>
                    <a class="btn btn-primary" href="{{ route('supplier.create') }}" wire:navigate>
                        <i class="fas fa-plus"></i> Tambah Supplier
                    </a>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" wire:model.live.debounce.300ms="search" 
                                   placeholder="Cari supplier..." class="form-control">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>
                                        <a href="#" wire:click.prevent="sortBy('nama_supplier')" class="text-white text-decoration-none">
                                            Nama Supplier
                                            @if ($sortField === 'nama_supplier')
                                                @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Total Produk</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->nama_supplier }}</td>
                                        <td>{{ Str::limit($supplier->alamat, 50) }}</td>
                                        <td>{{ $supplier->telepon }}</td>
                                        <td>{{ $supplier->produks_count }} produk</td>
                                        <td>
                                            <a href="{{ route('supplier.edit', $supplier->id) }}" 
                                               class="btn btn-sm btn-warning" wire:navigate>Edit</a>
                                            <button wire:click="destroy({{ $supplier->id }})" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin hapus supplier ini?')">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                Data supplier belum tersedia
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

