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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id('equipment_id');
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->integer('quantity')->default(1);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('equipment_type_id')->constrained('equipment_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
}; 