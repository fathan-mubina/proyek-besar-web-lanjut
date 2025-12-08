<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'progress',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'progress' => 'integer',
    ];

    /**
     * Relasi: Project dimiliki oleh User (creator)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Project memiliki banyak anggota (many-to-many)
     */
    public function anggota()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Relasi: Project memiliki banyak Tasks
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    /**
     * Relasi: Project memiliki banyak Comments
     */
    public function komentar()
    {
        return $this->hasMany(Comment::class, 'project_id')
                    ->orderBy('created_at', 'desc');
    }

    /**
     * Relasi: Project memiliki banyak Comments (alias)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'project_id');
    }
}
