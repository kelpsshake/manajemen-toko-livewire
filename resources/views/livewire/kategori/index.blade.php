<x-app-layout>
@section('title', 'Data Kategori')

<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Kategori</h5>
                    <a class="btn btn-primary" href="{{ route('kategori.create') }}" wire:navigate>
                        <i class="fas fa-plus"></i> Tambah Kategori
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
                                   placeholder="Cari kategori..." class="form-control">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>
                                        <a href="#" wire:click.prevent="sortBy('nama_kategori')" class="text-white text-decoration-none">
                                            Nama Kategori
                                            @if ($sortField === 'nama_kategori')
                                                @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th>Total Produk</th>
                                    <th>Tanggal Dibuat</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategoris as $kategori)
                                    <tr>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td>{{ $kategori->produks_count }} produk</td>
                                        <td>{{ $kategori->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('kategori.edit', $kategori->id) }}" 
                                               class="btn btn-sm btn-warning" wire:navigate>Edit</a>
                                            <button wire:click="destroy({{ $kategori->id }})" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin hapus kategori ini?')">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                Data kategori belum tersedia
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $kategoris->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>