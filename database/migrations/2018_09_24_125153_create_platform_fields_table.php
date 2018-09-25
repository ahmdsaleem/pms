<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('platform_id')->unsigned();
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->string('name');
            $table->string('input_name');
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
        Schema::dropIfExists('platform_fields');
    }
}
