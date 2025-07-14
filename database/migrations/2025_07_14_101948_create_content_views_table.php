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
        Schema::create('content_views', function (Blueprint $table) {
            $table->id();
            $table->string('content_type'); // Misalnya: blog, news, dsb
            $table->unsignedBigInteger('content_id'); // ID dari konten tersebut
            $table->unsignedBigInteger('views')->default(0); // jumlah views
            $table->timestamps();

            // Optional: indeks agar lebih cepat di-query
            $table->unique(['content_type', 'content_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_views');
    }
};
