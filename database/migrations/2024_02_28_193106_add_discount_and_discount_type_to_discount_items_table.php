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
        Schema::table('discount_items', function (Blueprint $table) {
            $table->enum('discount_type', ['Percentage', 'Nominal'])->after('item_id');
            $table->decimal('discount', 12, 2)->after('discount_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discount_items', function (Blueprint $table) {
            $table->dropColumn('discount_type');
            $table->dropColumn('discount');
        });
    }
};
