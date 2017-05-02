<?php namespace Starlight\PackageStatuses\Models;

class Status extends \Starlight\Kernel\Packages\AbstractModel {

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
	protected $fillable = ['title', 'slug'];

}
