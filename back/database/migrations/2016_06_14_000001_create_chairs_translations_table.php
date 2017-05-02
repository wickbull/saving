<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChairsTranslationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chairs_translations', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('chair_id')->unsigned();

            $table->string('title');

            $table->string('slug')->index();

            $table->longtext('body');

            $table->tinyinteger('is_active')->default(0)->index();

            $table->string('locale')->index();

            $table->unique(['chair_id','locale']);

            $table->foreign('chair_id')->references('id')->on('chairs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chairs_translations');
    }

}
