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
        Schema::table('community_stories', function (Blueprint $table) {
        $table->string('status')
              ->default('pengecekan')
              ->after('braille_mirrored_image');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_stories', function (Blueprint $table) {
            //
        });
    }
};
