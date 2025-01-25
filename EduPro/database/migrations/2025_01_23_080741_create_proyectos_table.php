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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->foreignId('tipo_proyecto_id')
            ->nullable()
            ->constrained('tipos_proyectos')
            ->onDelete('set null');
            $table->date('fecha_inicio');
            $table->date('fecha_limite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisiones'); // Primero elimina las tablas dependientes
        Schema::dropIfExists('evaluaciones'); // Luego elimina evaluaciones
        Schema::dropIfExists('calificaciones_finales'); // Luego elimina calificaciones_finales
        Schema::dropIfExists('proyectos');    // Finalmente, elimina proyectos
    }

};
