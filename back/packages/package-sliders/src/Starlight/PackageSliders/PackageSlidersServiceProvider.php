<?php namespace Starlight\PackageSliders;

class PackageSlidersServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

    /**
     * @var boolean
     */
    protected $migrations = true;

    /**
     * @var array
     */
    protected $controllers = ['PackageSlidersController'];

    /**
     * @var array
     */
    protected $models = ['Slider'];

    /**
     * @return void
     */
    public function init()
    {

        $this->addSidebarControl('package-sliders', '\Packages\PackageSlidersController@getList', [
            // 'parent' => $this->requireSidebarGroup('slider', _('Sliders'), 'pencil'),
            'title' => _('Sliders'),
            'icon' => 'picture-o',
        ]);
    }

}
