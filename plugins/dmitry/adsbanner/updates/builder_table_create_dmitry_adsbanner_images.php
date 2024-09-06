<?php namespace Dmitry\AdsBanner\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDmitryAdsbannerImages extends Migration
{
    public function up()
    {
        Schema::create('dmitry_adsbanner_images', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->text('description');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dmitry_adsbanner_images');
    }
}
