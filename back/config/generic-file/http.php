<?php

return [

	// domain to access files

	'domain' => env('GENERIC_FILE_URL', env('APP_STATIC_URL', 'http://hroniky')),

	// inperpolate path for just uploaded file

	'path_pattern' => '/content/files/{contentHash|subpath}/{contentHash}.{ext}',

];
