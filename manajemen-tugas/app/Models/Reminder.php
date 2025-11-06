<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'waktu_pengingat', 'status'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
