@section('title', 'Tambah Supplier')

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Tambah Data Supplier</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Nama Supplier <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama_supplier') is-invalid @enderror" 
                               id="nama_supplier"
                               placeholder="Masukkan nama supplier" 
                               wire:model="nama_supplier" />
                        @error('nama_supplier')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea 
                            class="form-control @error('alamat') is-invalid @enderror" 
                            id="alamat"
                            placeholder="Masukkan alamat supplier" 
                            wire:model="alamat" rows="3"></textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('telepon') is-invalid @enderror" 
                               id="telepon"
                               placeholder="Masukkan nomor telepon" 
                               wire:model="telepon" />
                        @error('telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('supplier.index') }}" wire:navigate class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
