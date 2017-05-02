<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 *
	 *
	 */
	protected $fillable = [
		'email',
		'password',
		'first_name',
		'nickname',
		'photo_storage_id',
		'last_name',
	];

	/**
	 * [$timestamps description]
	 * @var boolean
	 */
	public $timestamps = true;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * @param void
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

	/**
	 * @return string
	 */
	public function getPhotoUrl()
	{
		if ($this->email)
		{
			return '//www.gravatar.com/avatar/' . md5($this->email) . '?s=50&d=wavatar';
		}

		return '';
	}

	/**
	 * @return string
	 */
	public function getDetailsUrl()
	{
		return '';
	}

	/**
	 * Get user fullname
	 *
	 * @return string
	 */
	public function fullname()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

}
