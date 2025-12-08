<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('tugas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi')->nullable();
        $table->string('status')->default('Belum Mulai');
        $table->string('prioritas')->default('Rendah');
        $table->string('kategori')->nullable();
        $table->date('deadline')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('tugas');
}

};
