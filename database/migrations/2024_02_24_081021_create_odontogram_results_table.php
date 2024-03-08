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
        Schema::create('odontogram_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examination_id')->constrained('examinations');
            $table->foreignId('odontogram_id')->constrained('odontograms');
            $table->string('tooth_number');
            $table->string('tooth_position');
            $table->longText('img_name');
            $table->integer('side');
            $table->string('diagnosis');
            $table->text('remark')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontogram_results');
    }
};
