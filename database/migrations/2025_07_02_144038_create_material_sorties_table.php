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
        Schema::create('material_sorties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('employe_id')->nullable()->constrained('employee')->nullOnDelete();
            $table->unsignedBigInteger('chef_chantier_id')->nullable()->constrained('users')->nullOnDelete();
            $table->integer('quantite');
            $table->date('date_sortie');
            $table->string('raison');
            $table->string('destination');
            $table->string('statut_retour')->default('non_rendu'); // non_rendu, rendu, endommagé, perdu
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_sorties');
    }
};
