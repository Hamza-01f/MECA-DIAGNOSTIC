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
        Schema::table('diagnostics', function (Blueprint $table) {
          
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicule_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->enum('status', ['en_attente', 'complete','encours'])->default('en_attente');

            
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
