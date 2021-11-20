<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->date('birthdate')->nullable();
            $table->enum('sexo', ['m', 'h'])->nullable();
            $table->enum('status', ['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Unión libre'])->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('contacto_emergencia', 20)->nullable();
            $table->string('alergias', 20)->nullable();
            $table->date('hire_date');
            $table->text('observation', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
