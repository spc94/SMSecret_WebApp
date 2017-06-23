<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletesmsunencTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('deletesmsunenc', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('session_hash')->references('session_hash')->on('auth')->onDelete('cascade');
            $table->string('messageIDOnAndroid');
            $table->string('messageIDOnServer');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('deletesmsunenc');
	}

}
