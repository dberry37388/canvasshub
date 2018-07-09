<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('voter_id');
            $table->date('election_date')->index();
            $table->boolean('voted_early')->default(false)->index();
            $table->enum('party', ['D', 'R'])->nullable()->index();
            $table->string('original_data');
            $table->timestamps();
    
            $table->foreign('voter_id')
                ->references('id')->on('voters')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elections');
    }
}
