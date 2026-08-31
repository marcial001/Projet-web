<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('leaves', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
        $table->date('date_debut');
        $table->date('date_fin');
        $table->text('raison');
        $table->enum('statut', ['en attente', 'accepté', 'refusé'])->default('en attente');
        $table->foreignId('approuve_par')->nullable()->constrained('users')->onDelete('set null'); // Chef d'équipe ou RH
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
