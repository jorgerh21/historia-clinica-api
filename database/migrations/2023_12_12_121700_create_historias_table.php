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
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
			$table->integer('medico_id')
                    ->references('id')
                    ->on('users')->onDelete('cascade');
			$table->integer('paciente_id')
                    ->references('id')
                    ->on('users')->onDelete('cascade');
			$table->string('estado')->default('Sin Asistir');;
			$table->string('antecedentes');
			$table->string('evolucion');
			$table->string('concepto');
			$table->string('recomendaciones');
			$table->integer('consecutivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historias');
    }
};
