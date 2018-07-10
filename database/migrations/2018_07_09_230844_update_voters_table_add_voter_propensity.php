<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVotersTableAddVoterPropensity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voters', function (Blueprint $table) {
            $table->tinyInteger('republican_count')->default(0);
            $table->tinyInteger('democrat_count')->default(0);
            $table->tinyInteger('total_votes')->default(0);
            $table->double('percent_republican')->default(0);
            $table->double('percent_democrat')->default(0);
            $table->enum('propensity', config('voters.propensities'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voters', function (Blueprint $table) {
            $table->dropColumn([
                'propensity',
                'republican_count',
                'democrat_count',
                'total_votes',
                'percent_republican',
                'percent_democrat',
            ]);
        });
    }
}
