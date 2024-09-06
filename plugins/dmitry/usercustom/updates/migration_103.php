<?php namespace Dmitry\Usercustom\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class Migration103 extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'phone')) {
        $table->string('phone')->nullable();
    }
    if (!Schema::hasColumn('users', 'country_id')) {
        $table->integer('country_id')->unsigned()->nullable()->index();
    }
});
    }

    public function down()
    {
        $table->dropDown([
            'phone',
            'country_id'
            ]);
    }
}