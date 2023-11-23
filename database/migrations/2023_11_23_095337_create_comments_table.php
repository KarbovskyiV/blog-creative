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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(indexName: 'comments_user_fk');
            $table->foreignId('post_id')->constrained(indexName: 'comments_post_fk');
            $table->text('message');
            $table->timestamps();

            $table->index('post_id', 'comments_post_idx');
            $table->index('user_id', 'comments_user_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
