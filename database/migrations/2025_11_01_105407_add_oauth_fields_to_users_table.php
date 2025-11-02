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
        Schema::table('users', function (Blueprint $table) {
            $table->string("provider")->nullable(); //eg google, facebook , github etc
            $table->string("provider_id")->nullable()->after("provider"); // unique id assigned to a user
            $table->string("provider_token")->nullable()->after("provider_id");
            $table->string("provider_refresh_token")->nullable()->after("provider_token");

            $table->index(['provider', 'provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['provider', 'provider_id']);

            $table->dropColumn([
                'provider',
                'provider_id',
                'provider_token',
                'provider_refresh_token',
            ]);
        });
    }
};
