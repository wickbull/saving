<?php namespace Starlight\PackageDocuments\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Translatable;

class Document extends \Starlight\Kernel\Packages\AbstractModel {

	use SoftDeletes, Translatable;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * @var array
	 */
	public $date_format = 'd.m.Y';

	/**
	 * @var array
	 */
	public $date_format_each = ['publish_at' => 'd.m.Y'];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['publish_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $translatedAttributes = ['title'];

	protected $fillable = ['title', 'file_storage_id', 'thumb_storage_id', 'publish_at', 'year', 'is_active'];

	/**
	 * @param mixed $value
	 */
	public function setThumbStorageIdAttribute($value)
	{
		$this->attributes['thumb_storage_id'] = (integer) $value ?: null;
	}

	/**
	 * @param mixed $value
	 */
	public function setFileStorageIdAttribute($value)
	{
		$this->attributes['file_storage_id'] = (integer) $value ?: null;
	}

	/**
	 * @return array
	 */
	public static function getUploadFileFields()
	{
		return [
			'file_storage_id' => [
				'title' => 'File',
				'path'  => 'files',
			],
			'thumb_storage_id' => [
				'title' => 'Thumb',
				'path'  => 'thumb',
			],
		];
	}

}
