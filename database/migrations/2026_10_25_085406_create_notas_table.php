<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asignacion_id')->constrained('asignaciones')->cascadeOnDelete();
            $table->foreignId('estudiante_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('valor', 4, 2); // Notas de 0.00 a 10.00
            $table->string('observacion')->nullable();
            $table->timestamps();
            $table->unique(['asignacion_id', 'estudiante_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};