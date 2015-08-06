<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFriendRequestNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('friend_request_notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('sender_id')->unsigned()->index();
			$table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('receiver_id')->unsigned()->index();
			$table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
			$table->boolean('pending');
			$table->boolean('blocked')->nullable();
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
		Schema::drop('friend_request_notifications');
	}

}
