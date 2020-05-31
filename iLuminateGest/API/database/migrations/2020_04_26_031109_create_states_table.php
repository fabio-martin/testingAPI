<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('option');
            $table->string('color');

            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        DB::table('states')->insert(
            array(
                array('option'=>'Iniciado', 'color'=> 'amarelo'),
                array('option'=>'Em preparação', 'color'=> 'amarelo'),
                array('option'=>'Aguarda confeção', 'color'=> 'amarelo'),
                array('option'=>'Em confeção', 'color'=> 'amarelo'),
                array('option'=>'Pronto', 'color'=> 'amarelo'),
                array('option'=>'Entregue', 'color'=> 'amarelo'),
                array('option'=>'Aguardar', 'color'=> 'amarelo'),
                array('option'=>'Para Entrega', 'color'=> 'amarelo'),
                array('option'=>'Entregue', 'color'=> 'amarelo'),
                array('option'=>'Por pagar', 'color'=> 'amarelo'),
                array('option'=>'Pago', 'color'=> 'amarelo'),
                array('option'=>'Cancelado', 'color'=> 'amarelo'),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
