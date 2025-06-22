<?php

namespace App\Livewire\Produk;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterKategori = '';
    public $filterSupplier = '';
    public $sortField = 'nama_produk';
    public $sortDirection = 'asc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterKategori()
    {
        $this->resetPage();
    }

    public function updatingFilterSupplier()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $produks = Produk::with(['kategori', 'supplier'])
            ->when($this->search, fn($query) =>
                $query->where('nama_produk', 'like', '%' . $this->search . '%')
            )
            ->when($this->filterKategori, fn($query) =>
                $query->where('kategori_id', $this->filterKategori)
            )
            ->when($this->filterSupplier, fn($query) =>
                $query->where('supplier_id', $this->filterSupplier)
            )
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.produk.index', [
            'produks' => $produks,
            'kategoris' => Kategori::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    public function destroy($id)
{
    $produk = \App\Models\Produk::findOrFail($id);
    $produk->delete();

    session()->flash('success', 'Produk berhasil dihapus.');
}
}

