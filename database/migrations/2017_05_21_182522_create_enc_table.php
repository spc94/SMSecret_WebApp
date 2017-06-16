<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enc', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('session_hash')->references('session_hash')->on('auth')->onDelete('cascade');
            $table->string('phone_number');
            $table->text('message');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enc');
	}

}
