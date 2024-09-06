<?php namespace Dmitry\AdsBanner\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDmitryAdsbannerImages extends Migration
{
    public function up()
    {
        Schema::table('dmitry_adsbanner_images', function($table)
        {
            $table->integer('image_id')->nullable()->unsigned();
            $table->string('title', 255)->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('dmitry_adsbanner_images', function($table)
        {
            $table->dropColumn('image_id');
            $table->string('title', 255)->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
        });
    }
}
