<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFragmentsTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fragments_translations', function(Blueprint $table)
        {
            $table->dropColumn('slug');
        });

        Schema::table('fragments', function(Blueprint $table)
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
        Schema::table('fragments_translations', function(Blueprint $table)
        {
            $table->string('slug')->after('title')->index();
        });

        Schema::table('fragments', function(Blueprint $table)
        {
            $table->dropColumn('slug');
        });
    }

}
