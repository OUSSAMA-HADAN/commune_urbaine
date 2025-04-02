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
            $table->string('sujet');
            $table->text('contenu');
            $table->date('dateSoumission');
            $table->string('file_path')->nullable(); // Ajout de ce champ
            $table->timestamps();
        
            // Foreign key constraint
            $table->foreign('idOrdreMission')->references('id')->on('ordre_mission')->onDelete('cascade');
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
