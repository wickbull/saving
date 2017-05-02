<?php namespace App\Http\Controllers;

use Auth;
use View;
use Packages\GenericFile;
use App\Models\User;
use Packages\Publication;
use Packages\News;
use Packages\Lecturer;
use Packages\Slider;
use Request;

class HomeController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        View::share('sidebar_category_active', 'dashboard');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function getIndex()
    {
        $count_users = User::count();
        $count_news = News::count();

        return view('home')
            ->with('count_users', $count_users)
            ->with('count_news', $count_news);
    }

    /**
     *
     * @return json
     */
    public function getSliders()
    {
        $serch = Request::get('q');
        $sliders = Slider::where('title', 'like', '%'.$serch.'%')
            ->ordered()->isActive()->with('galleryImages')->paginate(6);

        return response()->json([
            'view' => view('sliders.items-window')
                ->with('sliders', $sliders)->render()
        ]);
    }

}
