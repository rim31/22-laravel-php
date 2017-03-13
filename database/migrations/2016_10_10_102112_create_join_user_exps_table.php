<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinUserExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_user_exps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('exp_id');
            $table->string('is_delete');
            $table->dateTime('time_del');
            $table->string('option_2');
            $table->string('actif')->default(1);
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
        Schema::drop('join_user_exps');
    }
}
