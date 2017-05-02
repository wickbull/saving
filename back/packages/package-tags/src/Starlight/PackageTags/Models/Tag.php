<?php namespace Starlight\PackageTags\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends \Starlight\Kernel\Packages\AbstractModel {

	use SoftDeletes;

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
	protected $fillable = ['name'];

}
