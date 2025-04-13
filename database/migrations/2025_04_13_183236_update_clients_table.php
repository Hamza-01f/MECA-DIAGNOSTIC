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
        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Remove old foreign key
            $table->renameColumn('user_id', 'client_id'); // Rename column
            $table->foreign('client_id')->references('id')->on('clients'); // New foreign key
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
