<?php namespace Dmitry\AdsBanner\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDmitryAdsbannerImages2 extends Migration
{
    public function up()
    {
        Schema::table('dmitry_adsbanner_images', function($table)
        {
            $table->renameColumn('title', 'link');
        });
    }
    
    public function down()
    {
        Schema::table('dmitry_adsbanner_images', function($table)
        {
            $table->renameColumn('link', 'title');
        });
    }
}
