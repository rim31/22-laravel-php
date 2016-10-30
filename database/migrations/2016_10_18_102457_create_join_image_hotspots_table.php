<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinImageHotspotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_image_spots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id');
            $table->integer('spot_id');
            $table->string('delete');
            $table->dateTime('time_del');
            $table->string('actif')->default(1);
            $table->integer('option_1');
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
                Schema::drop('join_image_spots');
    }
}
