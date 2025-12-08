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
     * Hitung progress dan update status proyek secara otomatis
     * berdasarkan tugas yang ada
     */
    public function updateProgress()
    {
        $totalTasks = $this->tasks()->count();

        // Jika tidak ada tugas sama sekali
        if ($totalTasks === 0) {
            $this->progress = 0;
            $this->status = 'Belum Mulai';
            $this->save();
            return $this->progress;
        }

        // Hitung jumlah tugas per status
        $completedTasks = $this->tasks()->where('status', 'Selesai')->count();
        $inProgressTasks = $this->tasks()->whereIn('status', ['Proses', 'Sedang'])->count();

        // Hitung progress (persentase tugas selesai)
        $this->progress = round(($completedTasks / $totalTasks) * 100);

        // Tentukan status berdasarkan kondisi tugas
        if ($completedTasks === $totalTasks) {
            // Semua tugas selesai
            $this->status = 'Selesai';
        } elseif ($inProgressTasks > 0 || $completedTasks > 0) {
            // Ada tugas yang sedang dikerjakan atau sudah ada yang selesai
            $this->status = 'Proses';
        } else {
            // Semua tugas masih "Belum Mulai"
            $this->status = 'Belum Mulai';
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

    /**
     * Accessor: Get status dengan logika otomatis
     */
    public function getStatusAttribute($value)
    {
        // Jika dipanggil tanpa eager loading, hitung langsung
        if (!$this->relationLoaded('tasks')) {
            $totalTasks = $this->tasks()->count();

            if ($totalTasks === 0) {
                return 'Belum Mulai';
            }

            $completedTasks = $this->tasks()->where('status', 'Selesai')->count();
            $inProgressTasks = $this->tasks()->whereIn('status', ['Proses', 'Sedang'])->count();

            if ($completedTasks === $totalTasks) {
                return 'Selesai';
            } elseif ($inProgressTasks > 0 || $completedTasks > 0) {
                return 'Proses';
            } else {
                return 'Belum Mulai';
            }
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
