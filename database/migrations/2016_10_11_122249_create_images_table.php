<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_name');
            $table->string('description');
            $table->string('cover_image');
            $table->string('actif')->default(1);
            $table->string('is_delete');
            $table->dateTime('time_del');
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
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
        Schema::drop('images');
    }
}
