<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'project_id',
        'judul',
        'deskripsi',
        'tanggal_deadline',
        'prioritas',
        'status',
        'assigned_to',
    ];

    protected $casts = [
        'tanggal_deadline' => 'date',
    ];

    /**
     * Relasi: Task dimiliki oleh User (pembuat)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Task dimiliki oleh Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relasi: Task dimiliki oleh Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Relasi: Task memiliki banyak Comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id');
    }

    /**
     * Relasi: Task memiliki banyak Reminders
     */
    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'task_id');
    }

    /**
     * Relasi: Task ditugaskan ke User
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
