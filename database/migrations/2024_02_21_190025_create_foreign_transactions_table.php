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
            $table->foreign('branch_id')->references('id')->on('branches')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('reservation_id')->references('id')->on('reservations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('doctor_id')->references('id')->on('doctors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('cashier_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['reservation_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['cashier_id']);
        });
    }
};
