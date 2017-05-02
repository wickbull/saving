<?php namespace Starlight\PackageNewsCategories\Models;

use App\Traits\Translatable;

class NewsCategory extends \Starlight\Kernel\Packages\AbstractModel {

	use Translatable;

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
	public $translatedAttributes = [
		'title',
        'slug',
        'is_active',
        'is_top'
	];

	protected $fillable = [
		'title',
		'slug',
		'is_active',
		'is_top'
	];

}
