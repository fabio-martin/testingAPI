<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('option');
            $table->string('color')->nullable();
            $table->string('icon')->nullable();

            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        DB::table('request_states')->insert(
            array(
                array('option' => 'First State', 'color' => 'danger', 'icon'=> 'fa-hourglass'),
                array('option' => 'Second State', 'color' => 'warning', 'icon'=> 'fa-hourglass-start'),
                  array('option' => 'First State', 'color' => 'info', 'icon'=> 'fa-hourglass-half'),
                array('option' => 'Second State', 'color' => 'success', 'icon'=> 'fa-check')
            )
        );

        Schema::create('request_product_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('option');
            $table->string('color')->nullable();

            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        DB::table('request_product_states')->insert(
            array(
                array('option' => 'First Product State', 'color' => 'danger'),
                array('option' => 'Second Product State', 'color' => 'warning')
            )
        );

        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idClient')->unsigned()->default(1);
            $table->foreign('idClient')->references('id')->on('clients');

            $table->integer('idProvenance')->unsigned();
            $table->foreign('idProvenance')->references('id')->on('provenances');

            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        Schema::create('request_state_rels', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idRequest')->unsigned();
            $table->foreign('idRequest')->references('id')->on('requests');

            $table->integer('idState')->unsigned()->default(1);
            $table->foreign('idState')->references('id')->on('request_states');

            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        Schema::create('request_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idRequest')->unsigned();
            $table->foreign('idRequest')->references('id')->on('requests');

            $table->integer('idProduct')->unsigned();
            $table->foreign('idProduct')->references('id')->on('products');

            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        Schema::create('request_product_state_rels', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idProduct')->unsigned();
            $table->foreign('idProduct')->references('id')->on('request_products');

            $table->integer('idState')->unsigned()->default(1);
            $table->foreign('idState')->references('id')->on('request_product_states');

            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
