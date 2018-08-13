<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('serial_number');
            $table->string('imei');
            $table->integer('user_id')->unsigned();
            $table->string('contact_1')->nullable();
            $table->string('contact_2')->nullable();
            $table->string('contact_3')->nullable();
            $table->string('center_lat');
            $table->string('center_lng');
            $table->integer('radius');
            $table->boolean('message_sent')->default(false);
            $table->dateTime('last_message_sent')->nullable();
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
        Schema::dropIfExists('devices');
    }
}
