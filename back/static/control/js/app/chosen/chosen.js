(function (window, $, undefined) {

	var Chosen = function (element) {

		this.$target = $(element);


		// init

		this.$target.chosen({
			width: '100%'
		});

	};

	$('.js-chosen').each(function () {

		this.chosen = new Chosen(this);

	});

})(window, jQuery);
