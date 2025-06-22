<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokLog extends Model
{
    use HasFactory;

    protected $fillable = ['produk_id', 'jenis', 'jumlah', 'tanggal', 'keterangan'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}