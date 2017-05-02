<?php namespace App\Models;


class Lecturer extends \Starlight\PackageLecturers\Models\Lecturer {


	/**
	 * @return array
	 */
	public function getIndexableFields()
	{
		return [
			'id'         => $this->id,
			'title'      => $this->title,
			'type'       => '\\Packages\\Lecturer',
			'subtitle'   => $this->title,
			'body'       => $this->body,
			'publish_at' => $this->publish_at->timestamp,
			'is_active'  => (boolean) $this->is_active,
		];
	}

	/**
	 * @return string
	 */
	public function getViewUrl()
	{
		return $this->getEditUrl();
	}

}
