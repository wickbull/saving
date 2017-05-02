
CKEDITOR.plugins.addExternal('oembed', '../ckeditor-oembed-plugin/' );
CKEDITOR.plugins.addExternal('codemirror', '../ckeditor-codemirror/codemirror/' );
CKEDITOR.plugins.addExternal('gallery', 'js/app/wysiwyg/gallery/' );

CKEDITOR.stylesSet.add('project-styles', [
	{ name: App.i18n('Callout'), element: 'p', attributes: { 'class': 'c-callout' } }
]);

CKEDITOR.editorConfig = function( config ) {

	config.toolbarGroups = [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'styles' },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
	];

	config.stylesSet = 'project-styles';

	config.startupOutlineBlocks = true;

	config.magicline_everywhere = true;

	config.allowedContent = true;

	config.oembed_WrapperClass = 'embed-responsive embed-responsive-16by9';

	config.contentsCss = [config.contentsCss, CKEDITOR.basePath + '/../../../css/wysiwyg.css?51aaf4bf'];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript,Table';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;h4';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.removePlugins = 'elementspath,resize,specialchar,maximize';

	config.extraPlugins = 'autogrow,iframe,justify,oembed,widget,sharedspace,showblocks,gallery';
	config.autoGrow_onStartup = true;
	config.autoGrow_minHeight = 100;

	config.codemirror = {
		autoCloseBrackets: true,
		autoCloseTags: true,
		autoFormatOnStart: true,
		continueComments: true,
		enableCodeFormatting: true,
		highlightMatches: true,
		indentWithTabs: false,
		lineNumbers: true,
		lineWrapping: true,
		mode: 'htmlmixed',
		matchBrackets: true,
		matchTags: true,
		showAutoCompleteButton: false,
		showCommentButton: false,
		showFormatButton: false,
		showSearchButton: false,
		showTrailingSpace: true,
		showUncommentButton: false,
		styleActiveLine: true,
		theme: 'default',
		useBeautify: false
	};

};
