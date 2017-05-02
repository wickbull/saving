<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Packages\Status;

class StatusTableSeeder extends Seeder {

	/**
	 *
	 * @return void
	 */
	public function run()
	{
		Status::create([
			'title' => 'Фото',
			'slug'  => 'i-photo',
		]);

		Status::create([
			'title' => 'Відео',
			'slug'  => 'i-video',
		]);

	}

}
