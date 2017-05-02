<?php namespace Starlight\PackageDocuments\Models;


class DocumentTranslation extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'documents_translations';
	public $timestamps = false;

	protected $fillable = ['title'];

}