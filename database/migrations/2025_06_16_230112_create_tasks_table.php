<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_create_tasks_table.php
public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description')->nullable();
        $table->enum('statut', ['en attente', 'en cours', 'terminée'])->default('en attente');
        $table->text('remarque');
        $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
        $table->foreignId('attribue_par')->constrained('users')->onDelete('cascade'); // Chef de chantier
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
