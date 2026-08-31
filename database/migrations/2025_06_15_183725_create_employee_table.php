<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    
public function up(): void
{
    Schema::create('employee', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('prenom');
        $table->string('phone');
        $table->string('fonction');
        $table->unsignedBigInteger('chef_chantier_id')->nullable();
        $table->foreign('chef_chantier_id')->references('id')->on('users')->onDelete('set null');
        $table->unsignedBigInteger('chef_equipe_id')->nullable(); // <-- SUPPRIME ->after('chef_chantier_id')
        $table->foreign('chef_equipe_id')->references('id')->on('users')->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
