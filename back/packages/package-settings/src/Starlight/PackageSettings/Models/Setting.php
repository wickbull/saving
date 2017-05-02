<?php namespace Starlight\PackageSettings\Models;

class Setting extends \Starlight\Kernel\Packages\AbstractModel {

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'name';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'settings';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'title', 'type', 'value', 'locale'];

}
