<?php namespace Starlight\PackageSliders\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends \Starlight\Kernel\Packages\AbstractModel {

    use SoftDeletes;

    /**
     * @var array
     */
    public $date_format = 'd.m.Y';

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
    protected $fillable = [
        'title',
        'slug',
        'is_active',
    ];

    /*
     *
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }

    /*
     *
     */
    public function scopeIsActive($query)
    {
        return $query->orderBy('is_active', true);
    }

    /**
     * @return relation
     */
    public function galleryImages()
    {
        return $this->morphMany('Packages\GalleryAttachableItem', 'galleriable')
            ->orderBy('position', 'ASC');
    }

}
