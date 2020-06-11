<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('nif')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->timestamps();
            $table->integer('active')->default(1);
            $table->engine = "InnoDB";
        });

        // Insert some stuff
        DB::table('clients')->insert(
            array(
                'name' => 'Consumidor Final',
                'nif' => '000000000'
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
        Schema::dropIfExists('clients');
    }
}
