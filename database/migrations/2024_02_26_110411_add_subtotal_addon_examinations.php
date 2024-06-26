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
        Schema::table('addon_examinations', function (Blueprint $table) {
            $table->integer('qty')->default(1);
            $table->double('sub_total', 10, 2)->default(0);
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->unsignedBigInteger('doctor_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addon_examinations', function (Blueprint $table) {
            $table->dropColumn('qty');
            $table->dropColumn('sub_total');
            $table->unsignedBigInteger('user_id')->change();
            $table->unsignedBigInteger('doctor_id')->change();
        });
    }
};
