<?php namespace Starlight\PackageLanguages\Models;

class Language extends \Starlight\Kernel\Packages\AbstractModel {


	public $timestamps = false;
	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'code';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code', 'title', 'locale', 'is_active'];

}
