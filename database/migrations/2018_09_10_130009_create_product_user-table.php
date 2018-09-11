<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductUserTable extends Migration
{

    public function up()
    {
        Schema::create('product_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('product_user');
    }
}
