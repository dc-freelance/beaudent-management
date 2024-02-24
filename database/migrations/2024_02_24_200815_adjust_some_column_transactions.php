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
            $table->dropForeign('transactions_reservation_id_foreign');
            $table->dropColumn('reservation_id');
            $table->dropColumn('status');

            $table->foreignId('examination_id')->constrained('examinations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->string('status');

            $table->dropForeign('transactions_examination_id_foreign');
            $table->dropColumn('examination_id');
        });
    }
};
