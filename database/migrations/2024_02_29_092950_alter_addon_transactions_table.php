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
        Schema::table('addon_transactions', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->nullable()->change();
            $table->bigInteger('doctor_id', false, true)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addon_transactions', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->change();
            $table->foreignId('doctor_id')->constrained('doctors')->change();
        });
    }
};
