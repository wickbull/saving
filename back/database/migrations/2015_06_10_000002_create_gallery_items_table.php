<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gallery_items', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');

			$table->text('descr')->nullable();

			$table->integer('gallery_id')->index();

			$table->integer('generic_file_id')->unsigned();

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
		Schema::drop('gallery_items');
	}

}

