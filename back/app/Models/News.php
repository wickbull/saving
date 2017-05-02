<?php namespace App\Models;


class News extends \Starlight\PackageNews\Models\News {

	/**
	 * @return array
	 */
	public function getIndexableFields()
	{
		return [
			'id'         => $this->id,
			'title'      => $this->title,
			'type'       => '\\Packages\\News',
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
		return env('VIEW_URL_DOMAIN') . 'news/view/' . $this->id . '-' . $this->slug;
	}

}
