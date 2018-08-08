<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notice extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('notice', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('notice');
			$table->unsignedInteger('hostel_id');
			$table->foreign('hostel_id')->references('id')->on('hostels')->onDelete('cascade');
			$table->string('administrator');
			$table->unsignedInteger('read')->default('0');
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
		Schema::dropIfExists('notice');
	}
}