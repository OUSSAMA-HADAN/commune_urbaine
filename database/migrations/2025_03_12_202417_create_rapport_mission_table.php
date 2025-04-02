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
        Schema::create('rapport_mission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idOrdreMission');
            $table->unsignedBigInteger('user_id'); // Add this line
            $table->string('sujet');
            $table->text('contenu');
            $table->date('dateSoumission');
            $table->string('file_path')->nullable();
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('idOrdreMission')->references('id')->on('ordre_mission')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Add this line
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapport_mission');
    }
};