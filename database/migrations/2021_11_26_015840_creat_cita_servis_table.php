<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatCitaServisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_Cliente');
            $table->unsignedBigInteger('servicio_id');  
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->date('fecha');
            $table->string('direccion',350)->nullable();;
            $table->text('descripcion',350)->nullable();;
            $table->float('precio',8,2);
            $table->boolean('estado');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
