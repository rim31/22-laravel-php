<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinExpImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_exp_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exp_id');
            $table->integer('image_id');
            $table->integer('video')->default(0);
            $table->integer('cover');
            $table->string('is_delete');
            $table->dateTime('time_del');
            $table->string('actif');
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
        Schema::drop('join_exp_images');
    }
}
