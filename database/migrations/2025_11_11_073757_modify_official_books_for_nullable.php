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
        Schema::table('official_books', function (Blueprint $table) {
            // Izinkan 'sipnosis_cerita' untuk menjadi NULL
            $table->text('sipnosis_cerita')->nullable()->change();
            
            // Izinkan 'gambar_cover' untuk menjadi NULL
            $table->string('gambar_cover')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('official_books', function (Blueprint $table) {
            // Kembalikan seperti semula jika di-rollback
            $table->text('sipnosis_cerita')->nullable(false)->change();
            $table->string('gambar_cover')->nullable(false)->change();
        });
    }
};