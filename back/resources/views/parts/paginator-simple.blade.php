@if ($target->currentPage() > 1)


	<a href="{{ action(substr(\Route::current()->getActionName(), strlen('App\\Http\\Controllers\\')), array_merge(\Route::current()->parameters(), \Input::all(), ['page' => $target->currentPage() - 1])) }}" class="btn btn-sm btn-bg btn-default"><i class="fa fa-chevron-left"></i></a>
@else
	<span class="btn btn-sm btn-bg btn-default disabled"><i class="fa fa-chevron-left"></i></span>
@endif

@if ($target->currentPage() < $target->lastPage())
	<a href="{{ action(substr(\Route::current()->getActionName(), strlen('App\\Http\\Controllers\\')), array_merge(\Route::current()->parameters(), \Input::all(), ['page' => $target->currentPage() + 1])) }}" class="btn btn-sm btn-bg btn-default"><i class="fa fa-chevron-right"></i></a>
@else
	<span class="btn btn-sm btn-bg btn-default disabled"><i class="fa fa-chevron-right"></i></span>
@endif
