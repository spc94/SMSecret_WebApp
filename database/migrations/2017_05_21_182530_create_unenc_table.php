<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnencTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unenc', function(Blueprint $table)
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
        Schema::drop('unenc');
    }

}
