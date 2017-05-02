<?php namespace Starlight\PackageFragments\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fragment extends \Starlight\Kernel\Packages\AbstractModel {

	use Translatable, SoftDeletes;

	public $translationModel = 'Starlight\PackageFragments\Models\FragmentTranslation';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = true;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $translatedAttributes = [
		'title',
		'body',
		'is_active',
	];

	protected $fillable = [
		'title',
		'slug',
		'body',
		'is_active',
	];

}
