<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetalleServicios', function (Blueprint $table) {+
            $table->id();
            $table->string('nombre_Servicio');
            $table->unsignedBigInteger('servicio_id');  
            $table->unsignedBigInteger('cita_id');  
            $table->float('precio',8,2);
     
        
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
