<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('day_id')->index()->unsigned();

            $table->integer('students_group_id')->index()->unsigned();

            $table->integer('lesson_number')->index()->unsigned();

            $table->string('title');

            $table->string('weeks_lessons')->nullable();

            $table->string('audience');

            $table->string('lecturer');

            $table->foreign('students_group_id')->references('id')->on('students_groups')->onDelete('cascade');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('timetables');
    }

}
