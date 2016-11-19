<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('about');
            $table->string('ville');
            $table->string('id_exp');
            $table->string('name_owner');
            $table->string('adress');
            $table->integer('surface');
            $table->integer('price')->unsigned();
            $table->integer('rooms')->default(1);
            $table->string('parking');
            $table->string('lift');
            $table->integer('level');
            $table->string('availability');
            $table->string('electricity');
            $table->string('class_nrj');
            $table->string('class_gaz');
            $table->string('photo');
            $table->string('video');
            $table->string('actif')->default(1);
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->boolean('online')->default(false);
            $table->string('delete');
            $table->dateTime('time_del');
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
        Schema::drop('exps');
    }
}
