<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
protected $fillable = [
    'user_id', 'category_id', 'project_id',
    'judul', 'deskripsi', 'tanggal_deadline',
    'prioritas', 'status'
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function project()
{
    return $this->belongsTo(Project::class);
}

public function assignedTo() {
    return $this->belongsTo(User::class, 'assigned_to');
}

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
