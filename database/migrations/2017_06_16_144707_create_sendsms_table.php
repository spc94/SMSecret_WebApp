<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendsmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('sendsms', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('session_hash')->references('session_hash')->on('auth')->onDelete('cascade');
            $table->string('destination');
            $table->string('message');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('sendsms');
	}

}
