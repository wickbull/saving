<?php namespace Starlight\PackageSliders\Controllers;

use Starlight\PackageSliders\Requests;
use Input;
use Packages;

class PackageSlidersController extends \Starlight\Kernel\Packages\AbstractController {

    /**
     * @return Response
     */
    public function getList()
    {
        if (Input::has('q')) {
            $sliders = Packages\Slider::where('title', 'LIKE', '%' . Input::get('q') . '%')
                ->ordered()
                ->paginate(15);
        } else {
            $sliders = Packages\Slider::ordered()->paginate(15);
        }

        return view('package-sliders::list', [
            'sliders' => $sliders
        ]);
    }

    /**
     * @return Response
     */
    public function getAdd()
    {
        return view('package-sliders::add');
    }

    /**
     * @param  Requests\AddRequest $request
     * @return Response
     */
    public function postAdd(Requests\AddRequest $request)
    {
        $slider = new \Packages\Slider($request->allWithRules());
        $slider->save();

        $this->handleInjected(['GalleriableAdd'], $slider, $request);

        return redirect(action('\Packages\PackageSlidersController@getList'))
            ->withMessagesSuccess([ _('Slider created successfully') ]);
    }

    /**
     * @param  Packages\Slider $slider
     * @return Response
     */
    public function getEdit(Packages\Slider $slider)
    {
        return view('package-sliders::edit', [
            'slider' => $slider
        ]);
    }

    /**
     * @param  Packages\Slider       $slider
     * @param  Requests\EditRequest  $request
     * @return Response
     */
    public function postEdit(Packages\Slider $slider, Requests\EditRequest $request)
    {
        $slider->fill($request->allWithRules());
        $slider->save();

        $this->handleInjected(['GalleriableEdit'], $slider, $request);

        return redirect(action('\Packages\PackageSlidersController@getList'))
            ->withMessagesSuccess([ _('Slider saved successfully') ]);
    }

    /**
     * @param
     * @return Response
     */
    public function deleteDelete(Packages\Slider $slider, Requests\DeleteRequest $request)
    {
        $this->handleInjected(['SlidersDelete'], $slider, $request);

        $slider->delete();

        return redirect(action('\Packages\PackageSlidersController@getList'))
            ->withMessagesSuccess([ _('Slider deleted successfully') ]);
    }

    /**
     * @return array
     */
    public function getCheckSlug()
    {
        return [
            'slug' => Input::get('slug'),
            'exists' => 0
        ];
    }

}
