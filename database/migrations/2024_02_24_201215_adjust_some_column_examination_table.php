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
        Schema::table('examinations', function (Blueprint $table) {
            $table->dropForeign('examinations_transaction_id_foreign');
            $table->dropColumn('transaction_id');
            $table->foreignId('reservation_id')->constrained('reservations')->after('id');
            $table->foreignId('doctor_id')->constrained('doctors')->after('medical_record_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examinations', function (Blueprint $table) {
            //
        });
    }
};
