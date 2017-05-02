<?php namespace Starlight\PackageLecturers\Models;

class LecturerTranslation extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'lecturers_translations';

	public $timestamps = false;

	protected $fillable = [
		'title',
		'slug',
		'birth',
		'position',
		'degree',
		'body',
		'is_active',
	];

	/**
	 * @param mixed $value
	 */
	public function setImageStorageIdAttribute($value)
	{
		$this->attributes['image_storage_id'] = (integer) $value ?: null;
	}

}
