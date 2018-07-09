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
            $table->char('e_1', 10);
            $table->char('e_2', 10);
            $table->char('e_3', 10);
            $table->char('e_4', 10);
            $table->char('e_5', 10);
            $table->char('e_6', 10);
            $table->char('e_7', 10);
            $table->char('e_8', 10);
            $table->char('e_9', 10);
            $table->char('e_10', 10);
            $table->char('e_11', 10);
            $table->char('e_12', 10);
            $table->char('e_13', 10);
            $table->char('e_14', 10);
            $table->char('e_15', 10);
            $table->char('e_16', 10);
            $table->char('e_17', 10);
            $table->char('e_18', 10);
            $table->char('e_19', 10);
            $table->char('e_20', 10);
            $table->char('e_21', 10);
            $table->char('e_22', 10);
            $table->char('e_23', 10);
            $table->char('e_24', 10);
            $table->char('e_25', 10);
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
