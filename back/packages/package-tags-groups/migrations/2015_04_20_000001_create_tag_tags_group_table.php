<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTagsGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tag_tags_group', function(Blueprint $table)
		{
			$table->primary(['tag_id', 'tags_group_id'], 'primary_key');

			$table->integer('tag_id');

			$table->integer('tags_group_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tag_tags_group');
	}

}
