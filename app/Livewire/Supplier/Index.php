<?php
namespace App\Livewire\Supplier;

use App\Models\Supplier;
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
        $supplier = Supplier::find($id);
        if ($supplier->produks()->count() > 0) {
            session()->flash('error', 'Supplier tidak dapat dihapus karena masih memiliki produk!');
            return;
        }
        
        $supplier->delete();
        session()->flash('success', 'Supplier berhasil dihapus!');
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
        $suppliers = Supplier::when($this->search, fn($q) =>
            $q->where('nama_supplier', 'like', '%' . $this->search . '%')
              ->orWhere('alamat', 'like', '%' . $this->search . '%')
              ->orWhere('telepon', 'like', '%' . $this->search . '%')
        )
        ->withCount('produks')
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate(10);

        return view('livewire.supplier.index', compact('suppliers'));
    }
}