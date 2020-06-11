<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->increments('id');
            $table->string('location')->unique();
            $table->string('color')->default('white');
            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        DB::table('provenances')->insert(
            array(
                array('location'=>'Service desk 1', 'color'=> 'blue'),
                array('location'=>'Table 1', 'color'=> 'green'),
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
