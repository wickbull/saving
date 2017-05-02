<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPagesTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages_translations', function(Blueprint $table)
        {
            $table->dropColumn('slug');
        });

        Schema::table('pages', function(Blueprint $table)
        {
            $table->string('slug')->after('id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages_translations', function(Blueprint $table)
        {
            $table->string('slug')->after('title')->index();
        });

        Schema::table('pages', function(Blueprint $table)
        {
            $table->dropColumn('slug');
        });
    }

}

