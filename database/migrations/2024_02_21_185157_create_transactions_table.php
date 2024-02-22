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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->bigInteger('branch_id', false, true);
            $table->bigInteger('reservation_id', false, true)->nullable();
            $table->dateTime('date_time');
            $table->bigInteger('doctor_id', false, true)->nullable();
            $table->bigInteger('customer_id', false, true);
            $table->enum('status', ['Reservation', 'Queue', 'Examination', 'Billing', 'Cancel']);
            $table->text('note')->nullable();
            $table->tinyInteger('is_paid')->default(0);
            $table->bigInteger('payment_method_id', false, true)->nullable();
            $table->bigInteger('cashier_id', false, true)->nullable();
            $table->enum('ppn_status', ['Without', 'Include', 'Exclude']);
            $table->decimal('total', 12, 2);
            $table->decimal('discount', 12, 2);
            $table->decimal('total_ppn', 12, 2);
            $table->decimal('grand_total', 12, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
