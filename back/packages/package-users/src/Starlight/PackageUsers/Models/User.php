<?php namespace Starlight\PackageUsers\Models;

use Packages;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Hash;


class User extends \Starlight\Kernel\Packages\AbstractModel implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

	/**
	 * [$timestamps description]
	 * @var boolean
	 */
	public $timestamps = true;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email',
		'password',
		'first_name',
		'last_name',
		'descr',
		'password',
		'photo_storage_id'
	];

	/**
	 * [$dates description]
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 *
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = $password;
	}

	/*
	 * @return array
	 */
	public static function getUploadFileFields()
	{
		return [
			'photo_storage_id' => [
				'title' => _('Photo'),
				'path'  => 'photo',
			],
		];
	}


	/**
	 *
	 */
	public function teams()
	{
		return $this->belongsToMany('\Packages\UsersTeam');
	}

	/**
	 *
	 */
	public function haveTeam($team_name)
	{
		return $this->teams()->where('name', '=', $team_name)->count();
	}


	/**
	 *
	 */
	public function setTeamByName($team_name)
	{
		if ($this->haveTeam($team_name))
			return true;

		$team = Packages\UsersTeam::where('name', '=', $team_name)->first();

		if (! $team)
			return false;

		return $this->teams()->attach($team->id);
	}

	/**
	 *
	 */
	public function getEditUrl()
	{
		return action('\Packages\PackageUsersController@getEdit', $this);
	}

	/**
	 *
	 */
	public function getMaterialsUrl()
	{
		return action('\Packages\PackageUsersController@getMaterials', $this);
	}

	/**
	 *
	 * @return string
	 */
	public function getViewUrlInListOfAnotherPackages()
	{
		return $this->getEditUrl();
	}
}

