<?php namespace Starlight\PackageDocuments\Requests;

class AddRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			'title'             => 'required|max:255',
			'file_storage_id'   => 'required|integer|exists:generic_files,id',
			'thumb_storage_id'  => 'integer|exists:generic_files,id',
			'publish_at'        => 'date_format:d.m.Y',
			'is_active'         => 'required|in:1,0',
		];
	}

}
