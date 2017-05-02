(function (window, $, undefined) {

	var Tags = function (element) {

		this.$target = $(element);

		this.$target.tagsinput();

	}

	$('.js-article-tags').each(function () {

		this.tags = new Tags(this);

	});

})(window, jQuery);
