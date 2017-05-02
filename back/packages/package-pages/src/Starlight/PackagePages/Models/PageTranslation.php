<?php namespace Starlight\PackagePages\Models;

class PageTranslation extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'pages_translations';
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
		'title',
		'page_id',
		'body',
		'is_active',
		'locale'
	];

}
