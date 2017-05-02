<?php namespace Starlight\PackageFragments\Models;

class FragmentTranslation extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'fragments_translations';
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
		'fragment_id',
		'body',
		'is_active',
		'locale'
	];

}
