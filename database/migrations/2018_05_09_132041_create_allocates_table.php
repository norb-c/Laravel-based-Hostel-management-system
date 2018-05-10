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
				$table->unsignedInteger('user_id');
				$table->unsignedInteger('campus_id');
				$table->unsignedInteger('hostel_id');
				$table->unsignedInteger('room_no');
				$table->unsignedInteger('bed_no');
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