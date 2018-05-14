<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocatesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('allocates', function (Blueprint $table) {
			$table->increments('id');
		});
		
		Schema::table('allocates', function (Blueprint $table) {
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->unsignedInteger('campus_id');
			$table->foreign('campus_id')->references('id')->on('campuses')->onDelete('cascade');
			$table->unsignedInteger('hostel_id');
			$table->foreign('hostel_id')->references('id')->on('hostels')->onDelete('cascade');
			$table->unsignedInteger('type');
			$table->unsignedInteger('floor');
			$table->unsignedInteger('room_no');
			$table->string('bed');
			$table->string('receipt');
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
		Schema::dropIfExists('allocates');
	}
}