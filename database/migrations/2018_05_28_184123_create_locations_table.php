<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('longitude', 9, 6);
            $table->decimal('latitude', 9, 6);
            $table->decimal('speed', 5, 2);
            $table->decimal('altitude', 8, 3);
            $table->integer('satellites')->unsigned();
            $table->dateTime('timestamp');
            $table->string('serial_number');
            $table->integer('device_id');
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
        Schema::dropIfExists('locations');
    }
}
