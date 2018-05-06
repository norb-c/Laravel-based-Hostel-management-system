<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
				$table->increments('id');
				$table->String('name');
				$table->unsignedInteger('type');
            $table->timestamps();
		  });
		  

		  Schema::table('hostels', function (Blueprint $table) {
			$table->unsignedInteger('campus_id');
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
		  Schema::dropIfExists('hostels');
    }
}