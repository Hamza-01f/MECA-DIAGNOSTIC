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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the service (e.g., "Vidange")
            $table->enum('type', ['quick', 'long']); // Type of service (quick or long)
            $table->decimal('price', 8, 2); // Price of the service
            $table->string('image')->nullable(); // Image URL for the service
            $table->string('vehicle_model')->nullable(); // Vehicle model (e.g., "Renault Clio")
            $table->integer('mileage')->nullable(); // Mileage (e.g., 50000)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
