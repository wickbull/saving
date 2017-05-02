function diffUsingJS($base, $new, $output) {
	// get the baseText and newText values from the two textboxes, and split them into lines
	var base = difflib.stringAsLines($base.val());
	var newtxt = difflib.stringAsLines($new.val());

	// create a SequenceMatcher instance that diffs the two sets of lines
	var sm = new difflib.SequenceMatcher(base, newtxt);

	// get the opcodes from the SequenceMatcher instance
	// opcodes is a list of 3-tuples describing what changes should be made to the base text
	// in order to yield the new text
	var opcodes = sm.get_opcodes();

	$output.empty();

	// build the diff view and add it to the current DOM
	$output.html(diffview.buildView({
		baseTextLines: base,
		newTextLines: newtxt,
		opcodes: opcodes,
		// set the display titles for each resource
		baseTextName: $base.data('text'),
		newTextName: $new.data('text'),
		viewType: 0
	}));

	// scroll down to the diff view window.
	// location = url + "#diff";
}

$('.js-diff-container').each(function (key, el) {
	$el = $(el);
	var $base   = $el.find('.js-diff-base-text');
	var $new    = $el.find('.js-diff-new-text');
	var $output = $el.find('.js-diff-output');
	diffUsingJS($base, $new, $output);
});
