<?php namespace Starlight\PackageLecturers\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Translatable;

class Lecturer extends \Starlight\Kernel\Packages\AbstractModel {

    use Translatable, SoftDeletes;

    public $translationModel = '\Starlight\PackageLecturers\Models\LecturerTranslation';

    /**
     * @var array
     */
    public $date_format = 'd.m.Y';

    /**
     * @var array
     */
    public $date_format_each = ['birth' => 'd.m.Y'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['birth', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $translatedAttributes = [
        'title',
        'slug',
        'position',
        'degree',
        'body',
        'is_active',
    ];

    protected $fillable = [
        'title',
        'slug',
        'birth',
        'image_storage_id',
        'position',
        'degree',
        'email',
        'telephone',
        'body',
        'is_active',
        'is_dean',
    ];

    /*
     *
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    /**
     * @param mixed $value
     */
    public function setImageStorageIdAttribute($value)
    {
        $this->attributes['image_storage_id'] = (integer) $value ?: null;
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
            ]
        ];
    }

    /**
     *
     * @return string
     */
    public function getEditUrl()
    {
        return  action('\Packages\PackageLecturersController@getEdit', $this);
    }

    /**
     *
     * @return string
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
