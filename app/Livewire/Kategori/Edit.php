<?php
namespace App\Livewire\Kategori;

use App\Models\Kategori;
use Livewire\Component;

class Edit extends Component
{
    public $kategori_id;
    public $nama_kategori;

    protected $rules = [
        'nama_kategori' => 'required|min:3|max:100'
    ];

    protected $messages = [
        'nama_kategori.required' => 'Nama kategori wajib diisi.',
        'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
        'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.'
    ];

    public function mount($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->kategori_id = $kategori->id;
        $this->nama_kategori = $kategori->nama_kategori;
    }

    public function update()
    {
        $this->validate([
            'nama_kategori' => 'required|min:3|max:100|unique:kategoris,nama_kategori,' . $this->kategori_id
        ]);

        Kategori::findOrFail($this->kategori_id)->update([
            'nama_kategori' => $this->nama_kategori
        ]);

        session()->flash('success', 'Kategori berhasil diperbarui!');
        return $this->redirectRoute('kategori.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.kategori.edit');
    }
}