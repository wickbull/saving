<?php namespace Starlight\PackageUsers\Controllers;

use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use Starlight\PackageUsers\Requests;
use Packages;
use Input;
use Mail;
use Hash;
use App;
use DB;

class PackageUsersController extends \Starlight\Kernel\Packages\AbstractController {


	protected $tokens;

	public function __construct(TokenRepositoryInterface $tokens)
	{
		$this->tokens = $tokens;
		$this->middleware('auth', ['except' => ['getResetPasswordAction', 'postResetPasswordAction']]);
	}

	/**
	 * @return Response
	 */
	public function getList()
	{
		$input = Input::all();


		if (isset($input['search']))
			$users = Packages\User::where('first_name', 'like', '%' .$input['search']. '%')->orWhere('last_name', 'like', '%' .$input['search']. '%');
		else
			$users = Packages\User::whereNotNull('id');

		if (!empty($input['by']) && !empty($input['order']))
			$users->orderBy($input['by'], $input['order']);

		return view('package-users::list', [
			'title'	=> _('Users'),
			'users' => $users->paginate(15),
		]);
	}

	/**
	 * @return Response
	 */
	public function getAdd()
	{
		return view('package-users::add');
	}

	/**
	 * @return Response
	 */
	public function getMaterials(Packages\User $user, \Illuminate\Http\Request $request)
	{
		return view('package-users::materials', ['user' => $user]);
	}


	/**
	 * @param  Requests\AddRequest $request
	 * @return Response
	 */
	public function postAdd(Requests\AddRequest $request)
	{
		$user = new \Packages\User($request->allWithRules());

		$user->password = bcrypt($user->password);

		$user->save();

		$this->handleInjected(['UsersAdd', 'StoragableAdd'], $user, $request);

		return redirect(action('\Packages\PackageUsersController@getList'))
			->withMessagesSuccess([_('User created successfully')]);
		;
	}

	/**
	 * @param  Packages\User $user
	 * @return Response
	 */
	public function getEdit(Packages\User $user)
	{
		return view('package-users::edit', [
			'user' => $user
		]);
	}

	/*
	 * @param  Packages\User       $user
	 * @param  Requests\EditRequest  $request
	 * @return Response
	 */

	public function postEdit(Packages\User $user, Requests\EditRequest $request)
	{
		$user->fill($request->allWithRules());

		$user->save();

		$this->handleInjected(['UsersEdit','StoragableAdd'], $user, $request);

		return redirect(action('\Packages\PackageUsersController@getList'))
			->withMessagesSuccess([_('Users saved successfully')]);
		;
	}


	/*
	*
	 */
	public function postSendResetPasswordAction(Packages\User $user)
	{
		$token = $this->tokens->create($user);

		Mail::send('package-users::emails.password-reset', ['token' => $token, 'user' => $user], function ($message) use ($user)
		{
			$message->to($user->email, _('Support Starlight'))->subject(_('Password Reset for Starlight Control Center account'));
		});

		return redirect(action('\Packages\PackageUsersController@getList'))
			->withMessagesSuccess([_('Mail with further instructions was sent to user')]);
	}

	/*
	*
	 */
	public function getResetPasswordAction($token)
	{
		$email_confirmation = DB::table('email_confirmations')->whereToken($token)->first();

		if (! $email_confirmation)
			App::abort('404');

		$user = Packages\User::whereEmail($email_confirmation->email)->firstOrFail();

		return view('package-users::password-reset', [
			'user' => $user
		]);
	}

	/*
	*
	 */
	public function postResetPasswordAction($token, Requests\PasswordResetRequest $request)
	{

		$email_confirmation = DB::table('email_confirmations')->whereToken($token)->first();

		if (! $email_confirmation)
			App::abort('404');

		$user = Packages\User::whereEmail($email_confirmation->email)->firstOrFail();

		$user->password = $request->get('password');

		$user->save();

		$this->tokens->delete($token);

		return redirect(route('control'))
			->withMessagesSuccess([_('Password was reseted successfully')]);
	}


	/*
	*
	 */
	public function postSendInviteAction(Packages\User $user)
	{
		$token = $this->tokens->create($user);

		Mail::send('package-users::emails.invite', ['token' => $token, 'user' => $user], function ($message) use ($user)
		{
			$message->to($user->email, _('Support Starlight'))->subject(_('Invite to Starlight Control Center'));
		});

		return redirect(action('\Packages\PackageUsersController@getList'))
			->withMessagesSuccess([_('Mail with further instructions was sent to user')]);
	}

	/*
	*
	 */
	public function getInviteAction($token)
	{
		$email_confirmation = DB::table('email_confirmations')->whereToken($token)->first();

		if (! $email_confirmation)
			App::abort('404');

		$user = Packages\User::whereEmail($email_confirmation->email)->firstOrFail();

		$user->setTeamByName('administrators');

		$this->tokens->delete($token);

		return redirect(route('control'))
			->withMessagesSuccess([_('Your have an administrator account now. Please log in.')]);
	}

	/**
	 * @param
	 * @return Response
	 */
	public function deleteDelete($user)
	{
		$user->delete();

		return redirect(action('\Packages\PackageUsersController@getList'))
			->withMessagesSuccess([_('User deleted successfully')]);
		;
	}

}
