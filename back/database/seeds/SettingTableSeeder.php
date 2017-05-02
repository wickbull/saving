<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Packages\Setting;

class SettingTableSeeder extends Seeder {

    /**
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' 	 => 'vkontakte',
            'title'  => 'Вконтакте',
            'type' 	 => 'socialPage',
            'value'  => 'https://vk.com/club84773882',
            'locale' => 'uk',
        ]);

        Setting::create([
            'name' 	 => 'facebook',
            'title'  => 'Facebook',
            'type' 	 => 'socialPage',
            'value'  => 'https://www.facebook.com/Факультет-інформаційних-систем-фізики-та-математики-828132637246018',
            'locale' => 'uk',
        ]);

        Setting::create([
            'name' 	 => 'twitter',
            'title'  => 'Twitter',
            'type' 	 => 'socialPage',
            'value'  => 'https://twitter.com/ispm_snu',
            'locale' => 'uk',
        ]);

    }

}
