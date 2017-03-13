<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('firstname');
            $table->string('email')->unique();
            $table->string('email_save');
            $table->string('password');
            $table->string('phone');
            $table->string('avatar');
            $table->string('society');
            $table->string('adress');
            $table->string('town');
            $table->string('country');
            $table->string('option');
            $table->string('paid_at');
            $table->string('iban');
            $table->string('duration');
            $table->string('max_exp_online_month');
            $table->string('token')->nullable();
            $table->string('validate')->default(0);
            $table->string('actif')->default(1);//si il a bien rentré l'IBAN ?
            $table->integer('option_1');
            $table->string('ban_id');
            $table->string('ban_ip');
            $table->string('is_delete');
            $table->dateTime('time_del');
            $table->dateTime('subscription_end');
            $table->string('package_select')->default(0);
            $table->string('payer_id')->default(0);
            $table->string('profil_id')->default(0);
            $table->string('token_payment');
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
        Schema::drop('users');
    }
}
