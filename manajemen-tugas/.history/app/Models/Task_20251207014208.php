<?php

dels;

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
     * Boot method untuk auto-update progress proyek
     */
    protected static function boot()
    {
        parent::boot();

        // Update progress ketika tugas dibuat
        static::created(function ($task) {
            if ($task->project_id) {
                $task->project->updateProgress();
            }
        });

        // Update progress ketika status tugas diubah
        static::updated(function ($task) {
            if ($task->project_id) {
                $task->project->updateProgress();
            }
        });

        // Update progress ketika tugas dihapus
        static::deleted(function ($task) {
            if ($task->project_id) {
                $task->project->updateProgress();
            }
        });
    }

    // ============================================
    // RELASI
    // ============================================

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'task_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
