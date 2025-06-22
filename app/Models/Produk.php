<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama_produk', 'harga', 'stok', 'kategori_id', 'supplier_id'];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function stokLogs()
    {
        return $this->hasMany(StokLog::class);
    }
}