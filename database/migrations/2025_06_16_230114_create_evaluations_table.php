<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_evaluations_table.php
public function up()
{
    Schema::create('evaluations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
        $table->integer('score'); // sur 10 ou 20
        $table->text('commentaire');
        $table->date('date');
        $table->foreignId('evalué_par')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
