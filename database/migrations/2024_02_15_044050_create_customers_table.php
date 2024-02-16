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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('identity_number');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('occupation');
            $table->string('phone_number');
            $table->string('religion');
            $table->string('email')->unique();
            $table->enum('marrital_status', ['Single', 'Married', 'Divorved']);
            $table->string('oral_issues');
            $table->string('note')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();
            $table->string('source_of_information')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
