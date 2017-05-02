<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsGroupsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_groups', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('semester_id')->unsigned();

            $table->string('title');

            $table->string('slug')->index();

            $table->string('specialty');

            $table->integer('course')->unsigned()->index();

            $table->tinyinteger('is_active')->default(0)->index();

            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

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
        Schema::drop('students_groups');
    }

}
