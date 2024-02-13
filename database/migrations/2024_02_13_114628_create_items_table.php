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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('category_id', false, true);
            $table->bigInteger('unit_id', false, true);
            $table->decimal('total_stock', 12, 2);
            $table->decimal('hpp', 12, 2);
            $table->enum('type', ['Medicine', 'BMHP']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('item_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('unit_id')->references('id')->on('item_units')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
