<?php
namespace App\Livewire\Kategori;

use App\Models\Kategori;
use Livewire\Component;

class Create extends Component
{
    public $nama_kategori;

    protected $rules = [
        'nama_kategori' => 'required|min:3|max:100|unique:kategoris,nama_kategori'
    ];

    protected $messages = [
        'nama_kategori.required' => 'Nama kategori wajib diisi.',
        'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
        'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',
        'nama_kategori.unique' => 'Nama kategori sudah ada.'
    ];

    public function store()
    {
        $this->validate();

        Kategori::create([
            'nama_kategori' => $this->nama_kategori
        ]);

        session()->flash('success', 'Kategori berhasil ditambahkan!');
        return $this->redirectRoute('kategori.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.kategori.create');
    }
}