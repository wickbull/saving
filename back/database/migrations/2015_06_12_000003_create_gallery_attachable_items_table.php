<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryAttachableItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gallery_attachable_items', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('generic_file_id')->unsigned();

			$table->integer('position')->unsigned()->index();

			$table->string('title')->nullable();

			$table->string('descr')->nullable();

			$table->string('crop')->nullable();

			$table->text('data')->nullable();

			$table->morphs('galleriable');

			$table->tinyinteger('is_watermarked')->default(0)->unsigned();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gallery_attachable_items');
	}

}
