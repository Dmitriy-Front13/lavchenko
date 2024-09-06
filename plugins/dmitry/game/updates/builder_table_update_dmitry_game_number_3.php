<?php namespace Dmitry\Game\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDmitryGameNumber3 extends Migration
{
    public function up()
    {
        Schema::table('dmitry_game_number', function($table)
        {
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('dmitry_game_number', function($table)
        {
            $table->dropColumn('updated_at');
        });
    }
}
