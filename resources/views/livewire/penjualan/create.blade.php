@section('title', 'Tambah Penjualan')

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Tambah Penjualan</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="mb-3">
                        <label class="form-label">Produk</label>
                        <select class="form-select @error('produk_id') is-invalid @enderror" wire:model="produk_id">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($produkList as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama_produk }} (Stok: {{ $produk->stok }})</option>
                            @endforeach
                        </select>
                        @error('produk_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                               wire:model="jumlah" placeholder="Jumlah penjualan">
                        @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('laporan.index') }}" wire:navigate class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>

                @if (session()->has('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
