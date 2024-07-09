<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    protected $fillable = [
    'id_status',
    'nama_status',
    'created_at',
    'updated_at',
    ];

    public function buku(){
        return $this->hasMany(Buku::class,'id_status', 'id_status');
    }
}
