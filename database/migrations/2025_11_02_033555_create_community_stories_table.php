<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('community_stories', function (Blueprint $table) {
            $table->id();
            
            // Kolom untuk menghubungkan ke tabel 'users'
            // Ini akan mencatat siapa user yang meng-upload
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Kolom dari permintaan awal Anda
            $table->string('judul');
            $table->string('penulis'); // Nama pena atau nama penulis
            $table->string('genre');
            $table->text('sipnosis');
            $table->string('gambar_cerita')->nullable(); // Path ke file gambar
            
            // Pilihan untuk konten
            $table->longText('isi_cerita')->nullable(); // Untuk text editor
            $table->string('upload_file')->nullable(); // Path ke file .docx
            
            // Kolom tambahan yang Anda minta
            $table->string('braille_file')->nullable(); // Path ke file Braille
            $table->string('braille_mirrored_image')->nullable(); // Path ke gambar cermin Braille
            
            $table->timestamps(); // Membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('community_stories');
    }
};