<?php namespace Dmitry\Game\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDmitryGameNumber extends Migration
{
    public function up()
    {
        Schema::table('dmitry_game_number', function($table)
        {
            $table->string('status')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('dmitry_game_number', function($table)
        {
            $table->dropColumn('status');
        });
    }
}
