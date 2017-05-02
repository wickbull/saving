<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFragmentsTranslationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragments_translations', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('fragment_id')->unsigned();

            $table->string('title');

            $table->string('slug')->index();

            $table->longtext('body')->nullable();

            $table->tinyinteger('is_active')->default(1)->unsigned()->index();

            $table->string('locale')->index();

            $table->unique(['fragment_id','locale']);

            $table->foreign('fragment_id')->references('id')->on('fragments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fragments_translations');
    }

}
