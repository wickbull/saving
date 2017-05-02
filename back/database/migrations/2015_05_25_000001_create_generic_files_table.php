<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenericFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('generic_files', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('original_name');

			$table->integer('generic_dir_id')->unsigned()->index();

			$table->integer('size')->unsigned();

			$table->string('mime');

			$table->char('hash', 32)->index();

			$table->string('ext');

			$table->text('descr');

			$table->string('label')->index();

			$table->integer('creator_id')->index();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('generic_files');
	}

}
