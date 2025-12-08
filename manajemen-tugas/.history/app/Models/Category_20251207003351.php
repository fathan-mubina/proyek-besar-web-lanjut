<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    /**
     * Relasi: Category memiliki banyak Tasks
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id');
    }

    /**
     * Alias untuk relasi tasks (jika ada yang menggunakan nama ini)
     */
    public function tugas()
    {
        return $this->hasMany(Task::class, 'category_id');
    }
}
