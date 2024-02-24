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
        Schema::create('shift_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('config_shift_id', false, true);
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->bigInteger('user_id', false, true);
            $table->bigInteger('branch_id', false, true);
            $table->decimal('total_cash_payment', 12, 2)->nullable();
            $table->decimal('total_cash_received', 12, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_logs');
    }
};
