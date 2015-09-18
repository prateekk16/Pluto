<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserBrowsingInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userBrowsingInfo', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->unique();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamp('last_login');
			$table->integer('last_global_post_read');
			$table->integer('last_friends_post_read');
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
		Schema::drop('userBrowsingInfo');
	}

}
