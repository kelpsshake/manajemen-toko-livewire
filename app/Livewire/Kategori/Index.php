<?php
namespace App\Livewire\Kategori;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if ($kategori->produks()->count() > 0) {
            session()->flash('error', 'Kategori tidak dapat dihapus karena masih memiliki produk!');
            return;
        }
        
        $kategori->delete();
        session()->flash('success', 'Kategori berhasil dihapus!');
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
        $kategoris = Kategori::when($this->search, fn($q) =>
            $q->where('nama_kategori', 'like', '%' . $this->search . '%')
        )
        ->withCount('produks')
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

        return view('livewire.kategori.index', compact('kategoris'));
    }
}