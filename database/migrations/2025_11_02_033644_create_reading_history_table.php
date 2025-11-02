<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_history', function (Blueprint $table) {
            $table->id();
            
            // Tautkan ke pengguna
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Ini adalah bagian Polimorfik
            // readable_id akan menyimpan ID (misal: 5)
            // readable_type akan menyimpan Model (misal: 'App\Models\Audiobook')
            $table->morphs('readable'); 
            
            // Timestamps akan berfungsi sebagai 'terakhir dibaca'
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_history');
    }
};