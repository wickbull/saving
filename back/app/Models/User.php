<?php namespace App\Models;

use Starlight\PackageUsers\Models\User as StarlightUser;

class User extends StarlightUser {

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
	 *
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = bcrypt($password);
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

	/**
	 *
	 * @return App\GenericFile
	 */
	public function photo()
	{
		return $this->belongsTo('\App\Models\GenericFile', 'photo_storage_id', 'id');
	}

	/**
	 *
	 * @return mixed
	 */
	public function getPhoto($size = false)
	{
		if ($this->photo)
		{
			return $this->photo->thumb($size);
		}

		return $this->getPhotoUrl();
	}

	/**
	 *
	 * @return string
	 */
	public function getViewUrlInListOfAnotherPackages()
	{
		return $this->getMaterialsUrl();
	}

}
