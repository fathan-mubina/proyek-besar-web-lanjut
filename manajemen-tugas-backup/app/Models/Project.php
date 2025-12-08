<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    protected $fillable = [
        'nama', 'deskripsi', 'tanggal_mulai',
        'tanggal_selesai', 'status', 'progress', 'user_id'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

   public function tasks() {
    return $this->hasMany(Task::class, 'project_id');
}

public function anggota() {
    return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
}

public function komentar() {
    return $this->hasMany(Komentar::class, 'project_id');
}

public function creator() {
    return $this->belongsTo(User::class, 'user_id');
}

}
