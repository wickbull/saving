<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTranslationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects_translations', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('subject_id')->unsigned();

            $table->string('title');

            $table->string('slug')->index();

            $table->longtext('body');

            $table->tinyinteger('is_active')->default(0)->index();

            $table->string('locale')->index();

            $table->unique(['subject_id','locale']);

            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subjects_translations');
    }

}
