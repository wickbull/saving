<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('title');
            $table->string('type');

            $table->string('lecturer_of_examen');
            $table->string('examination_room_of_examen');
            $table->timestamp('date_of_examen');

            $table->string('examination_room_of_elimination');
            $table->timestamp('date_of_elimination');

            $table->string('lecturers_of_commission');
            $table->string('examination_room_of_commission');
            $table->timestamp('date_of_commission');

            $table->integer('students_group_id')
                ->index()
                ->unsigned();

            $table->foreign('students_group_id')
                ->references('id')
                ->on('students_groups')
                ->onDelete('cascade');

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
        Schema::drop('examinations');
    }

}
