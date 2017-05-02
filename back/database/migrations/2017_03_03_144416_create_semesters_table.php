<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('title');

            $table->string('slug')->index();

            $table->timestamp('start_at')->nullable()->default(null);

            $table->timestamp('finish_at')->nullable()->default(null);

            $table->tinyinteger('is_active')->default(0)->index();

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
        Schema::drop('semesters');
    }

}
