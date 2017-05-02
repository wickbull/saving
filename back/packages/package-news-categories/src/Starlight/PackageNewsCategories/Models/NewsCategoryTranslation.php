<?php namespace Starlight\PackageNewsCategories\Models;

class NewsCategoryTranslation extends \Starlight\Kernel\Packages\AbstractModel {

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $table = 'news_categories_translations';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'is_active',
        'is_top'
    ];

}
