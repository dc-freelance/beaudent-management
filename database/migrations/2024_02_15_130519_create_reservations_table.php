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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->bigInteger('branch_id', false, true);
            $table->date('request_date');
            $table->timestamp('request_time');
            $table->string('anamnesis');
            $table->bigInteger('customer_id', false, true);
            $table->enum('status', ['Reservation', 'Cancel', 'Done']);
            $table->decimal('deposit', 12, 2)->nullable();
            $table->boolean('deposit_status')->default(false);
            $table->string('deposit_receipt')->nullable();
            $table->string('customer_bank_account')->nullable();
            $table->string('customer_bank')->nullable();
            $table->string('customer_bank_account_name')->nullable();
            $table->date('transfer_date')->nullable();
            $table->bigInteger('treatment_id', false, true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};