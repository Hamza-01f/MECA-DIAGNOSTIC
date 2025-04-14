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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('matricule')->unique();
            $table->string('model');
            $table->integer('kilometrage');
            $table->date('last_visit');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->integer('service_period'); 
            $table->integer('days_until_service')->nullable(); 
            $table->enum('status', ['À jour', 'Maintenance requise'])->default('À jour');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
