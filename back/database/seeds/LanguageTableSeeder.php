<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Packages\Language;

class LanguageTableSeeder extends Seeder {

	/**
	 *
	 * @return void
	 */
	public function run()
	{
		Language::create([
			'code' => 'uk',
			'title' => 'Українська',
			'locale' => 'uk_UA',
			'is_active' => '1',
		]);

		Language::create([
			'code' => 'en',
			'title' => 'English',
			'locale' => 'en_GB',
			'is_active' => '1',
		]);

	}

}
