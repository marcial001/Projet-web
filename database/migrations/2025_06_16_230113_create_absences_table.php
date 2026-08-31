<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_absences_table.php
public function up()
{
    Schema::create('absences', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
        $table->date('date');
        $table->text('raison');
        $table->foreignId('enregistré_par')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
