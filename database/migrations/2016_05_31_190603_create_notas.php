<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('templates_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('templates_id')->references('id')->on('templates');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('data');
            $table->string('pdf');
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
        //
        Schema::drop('notas');
    }
}
