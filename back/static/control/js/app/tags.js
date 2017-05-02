(function (window, $, undefined) {

	var Tags = function (element) {

		this.$target = $(element);

		this.$target.tagsinput({
			trimValue: true
		});

	}

	$('.js-tags').each(function () {

		this.tags = new Tags(this);

	});

})(window, jQuery);
