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
        Schema::table('examination_items', function (Blueprint $table) {
            $table->text('note_interaction')->nullable()->after('sub_total');
            $table->integer('amount_a_day')->nullable()->after('note_interaction');
            $table->integer('day')->nullable()->after('amount_a_day');
            $table->string('period')->nullable()->after('day');
            $table->integer('duration')->nullable()->after('period');
            $table->string('guide')->nullable()->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examination_items', function (Blueprint $table) {
            //
        });
    }
};
