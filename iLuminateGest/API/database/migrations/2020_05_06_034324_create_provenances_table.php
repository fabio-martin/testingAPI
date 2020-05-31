<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provenances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location');
            $table->string('color');
            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        DB::table('provenances')->insert(
            array(
                array('location'=>'Balcão 1', 'color'=> 'black'),
                array('location'=>'Balcão 2', 'color'=> 'black'),
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
        Schema::dropIfExists('provenances');
    }
}
