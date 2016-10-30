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
            $table->string('media_id');
            $table->string('shift_x');
            $table->string('shift_y');
            $table->string('shift_z');
            $table->string('position_x');
            $table->string('position_y');
            $table->string('position_z');
            $table->string('depth');
            $table->string('latitude');
            $table->integer('longitude');
            $table->integer('exp_id');
            $table->string('image_id');
            $table->string('image_idX');
            $table->string('image_idY');
            $table->string('image_link');
            $table->string('image_linkX');
            $table->string('image_linkY');
            $table->integer('description');
            $table->string('delete');
            $table->dateTime('time_del');
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->string('option_photo');
            $table->string('option_video');
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
