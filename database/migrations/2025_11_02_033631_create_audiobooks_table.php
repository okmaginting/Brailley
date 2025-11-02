<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audiobooks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('pengisi_audio');
            $table->string('file_audio'); // Path ke file MP3, M4A, dll.
            $table->string('gambar_cover')->nullable(); // Path ke file gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audiobooks');
    }
};