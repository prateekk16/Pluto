<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotFavouriteUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favourite_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('favourite_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('favourite_id')->references('id')->on('favourite_friends')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('favourite_user');
	}

}
