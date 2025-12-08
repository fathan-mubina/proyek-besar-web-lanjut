<?php

namespace App\Models;

// Komentar adalah alias untuk Comment
class Komentar extends Comment
{
    // Menggunakan tabel yang sama
    protected $table = 'comments';
}
