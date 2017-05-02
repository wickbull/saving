<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturersTranslationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers_translations', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('lecturer_id')->unsigned();

            $table->string('title');

            $table->string('slug')->index();

            $table->string('position')->nullable();

            $table->longtext('body');

            $table->tinyinteger('is_active')->default(0)->index();

            $table->string('locale')->index();

            $table->unique(['lecturer_id','locale']);

            $table->foreign('lecturer_id')->references('id')->on('lecturers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lecturers_translations');
    }

}
