<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sv');
            $table->integer('hw_version');
            $table->integer('fw_version');
            $table->integer('device_status');
            $table->integer('serial_number');
            $table->integer('battery');
            $table->integer('solar');
            $table->integer('precipitation');
            $table->double('avg_air_temp');
            $table->double('min_air_temp');
            $table->double('max_air_temp');

            $table->double('avg_humidity');
            $table->double('min_humidity');
            $table->double('max_humidity');

            $table->double('avg_deltaT');
            $table->double('min_deltaT');
            $table->double('max_deltaT');

            
            $table->double('avg_dewpoint');
            $table->double('min_dewpoint');

            $table->double('avg_vpd');
            $table->double('min_vpd');

            $table->integer('leaf_wetness');

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
        //
    }
}
