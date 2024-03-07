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
            $table->decimal('total_paid', 12, 2)->nullable()->after('grand_total');
            $table->decimal('nominal_paid', 12, 2)->nullable()->after('total_paid');
            $table->decimal('nominal_return', 12, 2)->nullable()->after('nominal_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('total_paid');
            $table->dropColumn('nominal_paid');
            $table->dropColumn('nominal_return');
        });
    }
};
