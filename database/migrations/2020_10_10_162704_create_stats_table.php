<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->string('team_name');
            $table->string('team_slug');
            $table->unsignedTinyInteger('points')->default(0);
            $table->unsignedTinyInteger('games')->default(0);
            $table->unsignedTinyInteger('wins')->default(0);
            $table->unsignedTinyInteger('losses')->default(0);
            $table->unsignedTinyInteger('draws')->default(0);
            $table->unsignedTinyInteger('goals_for')->default(0);
            $table->unsignedTinyInteger('goals_against')->default(0);
            $table->tinyInteger('goals_difference')->default(0);
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
        Schema::dropIfExists('stats');
    }
}
