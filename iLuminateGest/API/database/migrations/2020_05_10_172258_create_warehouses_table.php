<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('location');
            $table->unique(['name', 'location']);
            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";

        });

        DB::table('warehouses')->insert(array(
            array('name'=>'Armazém geral', 'location' => 'Seção geral'),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
}
