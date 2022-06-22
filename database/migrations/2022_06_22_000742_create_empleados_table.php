<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id')->comment('Identificador del empleado');
            $table->string("nombre",255)->comment('Nombre completo del empleado');
            $table->string("email",255)->comment('Correo electrónico del empleado');
            $table->char("sexo",1)->comment('Campo de sexo, M para Masculino. F para Femenino');
            $table->unsignedBigInteger("area_id")->comment('Area de la empresa a la que pertenece el empleado');
            $table->integer("boletin")->comment('1 para Recibir boletín. O para No recibir boletín');
            $table->text("descripcion")->comment('Se describe la experiencia del empleado');
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas');
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
