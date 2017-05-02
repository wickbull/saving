<?php

return [

	'encoding' => 'UTF-8',

	'finalize' => true,

	'preload'  => false,

	'cachePath' => storage_path('purifier'),

	'settings' => [
		'default' => [

			'HTML.Allowed'             => 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',

			'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',

			'AutoFormat.AutoParagraph' => true,

			'AutoFormat.RemoveEmpty'   => true,
		],
	],

];
