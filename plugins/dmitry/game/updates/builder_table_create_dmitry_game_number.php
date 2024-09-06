<?php namespace Dmitry\Game\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDmitryGameNumber extends Migration
{
    public function up()
    {
        Schema::create('dmitry_game_number', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('number');
            $table->integer('attempts')->default(0);
            
            $table->foreign('game_id')->references('id')->on('dmitry_game_')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dmitry_game_number');
    }
}