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
        Schema::table('examination_treatments', function (Blueprint $table) {
            $table->longText('proof')->nullable()->after('treatment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examination_treatments', function (Blueprint $table) {
            $table->dropColumn('proof');
        });
    }
};
