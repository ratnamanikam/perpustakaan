<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
    'id_peminjaman',
    'id',
    'id_buku',
    'tgl_peminjaman',
    'tgl_pengembalian',
    'id_status',
    'created_at',
    'updated_at',
    ];
}
