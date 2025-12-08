<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'comments'; 

    protected $fillable = [
        'project_id',
        'user_id',
        'isi_komentar',
    ];

    public function proyek()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
