<?php namespace Starlight\PackageDocuments\Controllers;

use Starlight\PackageDocuments\Requests;
use Packages;
use Input;
use Illuminate\Support\Facades\App;

class PackageDocumentsController extends \Starlight\Kernel\Packages\AbstractController {

	/**
	 * @return Response
	 */
	public function getList()
	{
		$documents = Packages\Document::paginate(15);

		return view('package-documents::list', [
			'documents' => $documents,
		]);
	}

	/**
	 * @return Response
	 */
	public function getAdd()
	{
		return view('package-documents::add');
	}

	/**
	 * @param  Requests\AddRequest $request
	 * @return Response
	 */
	public function postAdd(Requests\AddRequest $request)
	{

		$document = new \Packages\Document($request->allWithRules());
		$document->year = $document->publish_at->format('Y');
		$document->save();

		$this->handleInjected(['DocumentsAdd', 'StoragableAdd'], $document, $request);

		return redirect(action('\Packages\PackageDocumentsController@getList'))
			->withMessagesSuccess([_('New document created successfully')]);
	}

	/**
	 * @param  Packages\Document $document
	 * @return Response
	 */
	public function getEdit(Packages\Document $document)
	{
		$lang = Input::get('lang');
		App::make('config')->set('translatable.locale', $lang);

		return view('package-documents::edit', [
			'document' => $document,
			'lang' => $lang
		]);
	}

	/**
	 * @param  Packages\Document    $document
	 * @param  Requests\EditRequest  $request
	 * @return Response
	 */
	public function postEdit(Packages\Document $document, Requests\EditRequest $request)
	{
		App::make('config')->set('translatable.locale', $request->input('lang'));

		$document->fill($request->allWithRules());
		$document->year = $document->publish_at->format('Y');
		$document->save();

		$this->handleInjected(['DocumentsEdit', 'StoragableAdd'], $document, $request);

		return redirect(action('\Packages\PackageDocumentsController@getList'))
			->withMessagesSuccess([_('Document saved successfully')]);
	}


	/**
	 * @param  Packages\Document $document
	 * @return Response
	 */
	public function deleteDelete(Packages\Document $document)
	{
		$document->delete();

		return redirect(action('\Packages\PackageDocumentsController@getList'))
			->withMessagesSuccess([_('Document deleted successfully')]);
	}

}
