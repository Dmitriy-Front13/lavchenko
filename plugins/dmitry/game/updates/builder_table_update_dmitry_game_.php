<?php namespace Dmitry\Game\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDmitryGame extends Migration
{
    public function up()
    {
        Schema::table('dmitry_game_', function($table)
        {
            $table->integer('cash')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('dmitry_game_', function($table)
        {
            $table->dropColumn('cash');
        });
    }
}
