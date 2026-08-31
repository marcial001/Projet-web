<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('type')->in(['outil', 'véhicule', 'equipement']);
            $table->text('description')->nullable();
            $table->integer('quantite_disponible')->default(0);
            $table->string('localisation')->nullable();
            $table->string('statut')->default('disponible'); // disponible, en utilisation, en maintenance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
