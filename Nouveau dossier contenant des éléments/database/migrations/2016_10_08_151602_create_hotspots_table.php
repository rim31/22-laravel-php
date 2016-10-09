<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotspotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotspots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('id_exp');
            $table->string('name_owner');
            $table->string('adress');
            $table->string('surface');
            $table->string('price');
            $table->string('rooms');
            $table->string('parking');
            $table->string('lift');
            $table->string('level');
            $table->string('availability');
            $table->string('electricity');
            $table->string('class_nrj');
            $table->string('class_gaz');
            $table->string('photo');
            $table->string('video');
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->boolean('online')->default(false);
            $table->rememberToken();
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
        Schema::drop('hotspots');
    }
}
