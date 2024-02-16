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
        Schema::table('discount_treatments', function (Blueprint $table) {
            $table->foreign('discount_id')->references('id')->on('discounts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('treatment_id')->references('id')->on('treatments')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discount_treatments', function (Blueprint $table) {
            $table->dropForeign('discount_id');
            $table->dropForeign('treatment_id');
        });
    }
};
