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
            $table->string('owner');
            $table->string('matricule');
            $table->string('marque');
            $table->string('model');
            $table->decimal('kilometrage',10,8);
            $table->enum('status',['maintenance requis','à jour'])->default('à jour');
            $table->integer('user_id');
            $table->ForeignId('users_id')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
