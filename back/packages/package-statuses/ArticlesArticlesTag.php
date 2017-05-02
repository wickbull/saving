<?php namespace Starlight\PackageArticlesTags\Models;

class ArticlesArticlesTag extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'article_articles_tag';

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
	protected $fillable = ['tag_id', 'articles_tag_id'];

}
