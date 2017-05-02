<?php namespace Starlight\PackageStatuses\Models;

class statusable extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'article_articles_status';

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
	protected $fillable = ['status_id', 'statusable_id'];

	/**
	 * @return News Model
	 */
	public function news()
	{
		return $this->morphedByMany('\Packages\New', 'statusable');
	}

	/**
	 * @return Articles Model
	 */
	public function articles()
	{
		return $this->morphedByMany('\Packages\Article', 'statusable');
	}

}
