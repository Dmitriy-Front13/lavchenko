<?php namespace Dmitry\Game\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDmitryGame extends Migration
{
    public function up()
    {
        Schema::create('dmitry_game_', function($table)
        {
            $table->increments('id');
            $table->integer('secret_number')->nullable();
            $table->integer('total_cells')->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dmitry_game_');
    }
}
