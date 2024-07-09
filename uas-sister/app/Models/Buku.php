<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'bukus';
    protected $primaryKey = 'id_buku';
    protected $fillable = [
    'id_buku',
    'gambar',
    'judul',
    'penulis',
    'isbn',
    'tahun_terbit',
    'id_kategori',
    'created_at',
    'updated_at',
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class,'id_kategori', 'id_kategori');
    }
}
