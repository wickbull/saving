<?php namespace Starlight\PackageSliders\Requests;

class AddRequest extends \Starlight\Kernel\Requests\Request {

    /**
     * @var array
     */
    protected $inject_rules = ['SlidersAdd'];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => 'required|max:255',
            'slug'      => 'required|alpha_dash|max:255',
            'is_active' => 'required|in:1,0',
        ];
    }

}
