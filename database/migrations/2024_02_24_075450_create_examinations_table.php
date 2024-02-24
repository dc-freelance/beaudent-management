<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->foreignId('medical_record_id')->constrained('medical_records');
            $table->foreignId('customer_id')->constrained('customers');
            $table->date('examination_date');
            $table->double('systolic_blood_pressure');
            $table->double('diastolic_blood_pressure');
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->boolean('heart_disease');
            $table->boolean('diabetes');
            $table->boolean('blood_clotting_disorder');
            $table->boolean('hepatitis');
            $table->boolean('digestive_diseases');
            $table->boolean('other_diseases');
            $table->boolean('allergies_to_medicines');
            $table->text('medications')->nullable();
            $table->boolean('allergies_to_food');
            $table->text('foods')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
