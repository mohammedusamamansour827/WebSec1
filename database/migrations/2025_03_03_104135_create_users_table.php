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
        if (!Schema::hasTable('users')) { // ✅ Check if the table exists
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }
    } // ✅ Closing the up() function properly

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
