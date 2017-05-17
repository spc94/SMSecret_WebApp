<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTable extends Migration {

    public function up()
	{
		Schema::create('auth', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('session_hash');
			$table->string('phone_id');
			$table->timestamps();
		});
	}

    /**
     * Run the migrations.
     *
     * @return void
     */



    /**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('auth');
	}

}
