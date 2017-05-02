<?php namespace Starlight\PackageTagsGroups\Models;

class TagsGroup extends \Starlight\Kernel\Packages\AbstractModel {

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
	protected $fillable = ['title', 'slug', 'is_top', 'locale'];

}
