<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('county_id')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('title')->nullable();
            $table->string('registered_house_number')->nullable();
            $table->string('registered_street_address')->nullable();
            $table->string('registered_unit_type')->nullable();
            $table->string('registered_unit_number')->nullable();
            $table->string('registered_address')->nullable();
            $table->string('registered_address2')->nullable();
            $table->string('registered_city')->nullable();
            $table->string('registered_state')->nullable();
            $table->string('registered_zip5')->nullable();
            $table->string('registered_zip4')->nullable();
            $table->string('mailing_house_number')->nullable();
            $table->string('mailing_street_address')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('mailing_address2')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_state')->nullable();
            $table->string('mailing_zip5')->nullable();
            $table->string('mailing_zip4')->nullable();
            $table->string('phone')->nullable();
            $table->string('precinct_number')->nullable();
            $table->string('precinct')->index();
            $table->string('precinct_sub')->nullable();
            $table->date('dob')->nullable()->index();
            $table->char('gender', 20)->nullable()->index();
            $table->double('longitude')->nullable()->index();
            $table->double('latitude')->nullable()->index();
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
        Schema::dropIfExists('voters');
    }
}
