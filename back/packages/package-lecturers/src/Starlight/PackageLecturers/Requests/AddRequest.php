<?php namespace Starlight\PackageLecturers\Requests;

class AddRequest extends \Starlight\Kernel\Requests\Request {

    /**
     * @var array
     */
    protected $inject_rules = ['LecturersAdd'];

    /**
     * @return array
     */
    public function rules()
    {

        return [
            'title'             => 'required|max:255',
            'slug'              => 'required',
            'birth'             => '',
            'image_storage_id'  => 'integer|exists:generic_files,id',
            'position'          => '',
            'degree'            => '',
            'email'             => 'email',
            'telephone'         => '',
            'body'              => '',
            'is_active'         => 'required|in:1,0',
            'is_dean'           => 'required|in:1,0',
        ];
    }

}
