(function (window, $, undefined) {

	var showPreloader = function ($container, text) {
		$container.html($('<div/>', {'class': 'text-muted text-center wrapper', 'text': ' ' + text})
				.prepend($('<i/>', {'class': 'fa fa-cog fa-spin'})));
	};

	$('.js-search-form').on('submit', function (e) {
		e.preventDefault();

		var $this = $(this);
		var $container = $($this.data('container'));
		var $input = $this.find('input')

		var url = $this.attr('action') + '?q=' + encodeURIComponent($input.val());

		showPreloader($container, 'loading')

		$container.load(url, function () {
			console.debug('load items');
		});

	});

})(window, jQuery);
