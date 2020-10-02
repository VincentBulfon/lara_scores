<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id');
            $table->foreignId('match_id');
            $table->boolean('is_home')->nullable('false')->unsigned();
            $table->tinyInteger('goals')->nullable('false')->unsigned();
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
        Schema::dropIfExists('participation');
    }
}
