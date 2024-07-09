<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
    'id_kategori',
    'nama_kategori',
    'created_at',
    'updated_at',
    ];

    public function buku(){
        return $this->hasMany(Buku::class,'id_kategori', 'id_kategori');
    }
}
