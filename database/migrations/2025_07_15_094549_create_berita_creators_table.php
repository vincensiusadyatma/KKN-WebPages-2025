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
        Schema::create('berita_creators', function (Blueprint $table) {
          $table->id();

            // Foreign key user_id → users.id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Foreign key berita_id → beritas.id
            $table->foreignId('berita_id')->constrained('beritas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_creators');
    }
};
