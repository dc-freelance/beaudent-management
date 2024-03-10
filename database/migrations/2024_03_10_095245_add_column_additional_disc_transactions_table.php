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
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('additional_discount_type', ['percentage', 'nominal'])->nullable()->after('discount');
            $table->decimal('additional_discount_nominal', 12, 2)->nullable()->after('additional_discount_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('additional_discount_type');
            $table->dropColumn('additional_discount_nominal');
        });
    }
};
