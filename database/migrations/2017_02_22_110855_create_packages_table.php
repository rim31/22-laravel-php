<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('currency');
            $table->string('quantity');
            $table->string('sku');
            $table->string('price');
            $table->string('shipping');
            $table->string('tax');
            $table->dateTime('time_payment');
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->rememberToken();
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('packages');
    }
}
