<?php namespace Starlight\PackageNewsCategories\Models;

class NewsNewsCategory extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'news_news_category';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'news_id',
		'news_category_id'
	];

}
