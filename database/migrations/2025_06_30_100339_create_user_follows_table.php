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
        Schema::create('user_follows', function (Blueprint $table) {
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('followed_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['follower_id', 'followed_id']);

            $table->index('follower_id');
            $table->index('followed_id');

            // $table->check('follower_id <> followed_id'); // prevent self following
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_follows');
    }
};
