<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('messages', function (Blueprint $table) {
			$table->increments('id');
			$table->string('message');
			$table->unsignedInteger('admin');
			$table->unsignedInteger('student');
			$table->unsignedInteger('replied')->default('0');
			$table->unsignedInteger('admview')->default('0');
			$table->unsignedInteger('stdview')->default('0');
			$table->unsignedInteger('sent_del')->default('0');
			$table->unsignedInteger('rec_del')->default('0');

			$table->timestamps();
		});
		
		Schema::table('messages', function (Blueprint $table) {
			$table->unsignedInteger('user_id')->after('id');
			$table->foreign('user_id')->references('user_id')->on('allocates');
		});
	}
	
	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('messages');
		Schema::table('messages', function (Blueprint $table) {
			$table->dropForeign('messages_user_id_foreign');
	  });

	}
}