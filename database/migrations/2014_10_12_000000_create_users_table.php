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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
			$table->string('apellido');
			$table->bigInteger('identificacion')->unique();
			$table->boolean('primer')->default(false);
			$table->bigInteger('celular')->nullable();
			$table->string('ubicacion')->nullable();
			$table->integer('tipo_usuario_id')
                    ->references('id')
                    ->on('tipo_usuarios')->onDelete('cascade');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
