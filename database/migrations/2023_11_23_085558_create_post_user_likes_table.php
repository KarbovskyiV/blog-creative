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
        Schema::create('post_user_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained(indexName: 'pul_post_fk');
            $table->foreignId('user_id')->constrained(indexName: 'pul_user_fk');
            $table->timestamps();

            $table->index('post_id', 'pul_post_idx');
            $table->index('user_id', 'pul_user_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_user_likes');
    }
};
