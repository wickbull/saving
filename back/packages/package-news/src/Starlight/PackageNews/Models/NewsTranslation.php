<?php namespace Starlight\PackageNews\Models;


class NewsTranslation extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'news_translations';
	public $timestamps = false;

	protected $fillable = [
		'title',
		'slug',
		'subtitle',
		'body',
		'is_active',
	];

}
