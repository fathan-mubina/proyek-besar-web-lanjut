<?php

<?php

// ========================================
// 1. Category Model - app/Models/Category.php
// ========================================
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

// ========================================
// 2. Task Model - app/Models/Task.php
// ========================================
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
