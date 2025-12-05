<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas'; // nama tabel, kalau tabelmu "tugas"

    protected $fillable = [
        'judul',
        'deskripsi',
        'status',
        'prioritas',
        'kategori',
        'deadline',
        'user_id',  
    ];
}
