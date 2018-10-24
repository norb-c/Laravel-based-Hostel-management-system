<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name',60);
			$table->string('email')->unique();
			$table->string('surname', 60);
			$table->unsignedInteger('regno')->unique();
			$table->string('gender',10);
			$table->string('department', 60);
			$table->string('phone', 30);
			$table->string('state', 30);
			$table->string('address');
			$table->string('nok', 60);
			$table->string('nokno', 20);
			$table->string('passport');
			$table->string('password');
			$table->rememberToken();
			$table->timestamps();
		});
		
		Schema::table('users', function (Blueprint $table) {
			$table->unsignedInteger('campus_id')->after('gender');
			$table->foreign('campus_id')->references('id')->on('campuses')->onDelete('cascade');
		});
	}
	
	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->dropForeign('users_campus_id_foreign');
	  });
	
		Schema::dropIfExists('users');
	}
}