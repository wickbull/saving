<?php namespace App\Models;


class Publication extends \Starlight\PackagePublications\Models\Publication {

	/**
	 * @return array
	 */
	public function getIndexableFields()
	{
		return [
			'id'         => $this->id,
			'title'      => $this->title,
			'type'       => '\\Packages\\Publication',
			'subtitle'   => $this->subtitle,
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
		return env('VIEW_URL_DOMAIN') . 'publications/view/' . $this->id . '-' . $this->slug;
	}

}
