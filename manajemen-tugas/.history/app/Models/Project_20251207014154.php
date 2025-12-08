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
     * Hitung progress proyek berdasarkan tugas yang selesai
     */
    public function updateProgress()
    {
        $totalTasks = $this->tasks()->count();

        if ($totalTasks === 0) {
            $this->progress = 0;
        } else {
            $completedTasks = $this->tasks()
                ->where('status', 'Selesai')
                ->count();

            $this->progress = round(($completedTasks / $totalTasks) * 100);
        }

        $this->save();

        return $this->progress;
    }

    /**
     * Accessor: Get progress dengan update otomatis
     */
    public function getProgressAttribute($value)
    {
        // Jika dipanggil tanpa eager loading tasks, hitung langsung
        if (!$this->relationLoaded('tasks')) {
            $totalTasks = $this->tasks()->count();
            if ($totalTasks === 0) {
                return 0;
            }
            $completedTasks = $this->tasks()->where('status', 'Selesai')->count();
            return round(($completedTasks / $totalTasks) * 100);
        }

        return $value;
    }

    // ============================================
    // RELASI
    // ============================================

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function anggota()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function komentar()
    {
        return $this->hasMany(Comment::class, 'project_id')
                    ->orderBy('created_at', 'desc');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'project_id');
    }
}
