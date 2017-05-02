<?php namespace Starlight\PackageNews\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends \Starlight\Kernel\Packages\AbstractModel {

    use Translatable, SoftDeletes;

    public $translationModel = '\Starlight\PackageNews\Models\NewsTranslation';

    /**
     * @var array
     */
    public $date_format = 'd.m.Y';

    /**
     * @var array
     */
    public $date_format_each = ['publish_at' => 'd.m.Y H:i'];

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

    public $translatedAttributes = [
        'title',
        'slug',
        'subtitle',
        'body',
        'is_active',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image_storage_id',
        'subtitle',
        'body',
        'is_active',
        'is_top',
        'creator_id',
        'editor_id',
        'publish_at',
    ];

    /**
     * @param mixed $value
     */
    public function setImageStorageIdAttribute($value)
    {
        $this->attributes['image_storage_id'] = (integer) $value ?: null;
    }

    /*
    *
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('publish_at', 'DESC');
    }

    /**
     * @return array
     */
    public static function getUploadFileFields()
    {
        return [
            'image_storage_id' => [
                'title' => _('Image'),
                'path'  => 'image',
            ],
        ];
    }

    /**
     * @return  string
     */
    public function getType()
    {
        return 'News';
    }

    /**
     * @return  Action
     */
    public function getEditUrl()
    {
        return action('\Packages\PackageNewsController@getEdit', $this);
    }

    /**
     * @return  Action
     */
    public function getViewUrl()
    {
        return $this->getEditUrl();
    }

    /**
     *
     * @return
     */
    public function creator()
    {
        return $this->belongsTo('Packages\User', 'creator_id', 'id');
    }

    /**
     *
     * @return
     */
    public function editor()
    {
        return $this->belongsTo('Packages\User', 'editor_id', 'id');
    }

}
