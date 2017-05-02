(function (window, $, undefined) {

	var RightSidebar = function (control) {

		var self = this;

		this.$panel         = $(control);
		this.$shortcuts     = $(this.$panel.data('shortcuts'));
		this.$shortcutsTabs = this.$shortcuts.find('ul > li > a');

		this.$tabs          = self.$panel.find('.js-right-sidebar-tabs > li > a');

		this.$panel.find('.js-right-sidebar-toggle').on('click', function (e) {

			e.preventDefault();

			self.toggle();

		});

		this.$shortcutsTabs.each(function () {
			var $this = $(this);

			$this.on('click', function (e) {

				e.preventDefault();

				self.$tabs.filter('[href=' + $this.attr('href') + ']')
					.parent().addClass('active').siblings().removeClass('active');

				self.toggle();

				setTimeout(function () {
					$this.parent().removeClass('active');
				}, 1);
			});
		});

		if (this.$shortcutsTabs.length) {
			this.$shortcuts.removeClass('hide');
		}

	};

	RightSidebar.prototype.toggle = function () {

		this.$panel.toggleClass('hide');

		this.$shortcuts.toggleClass('hide');

	};

	$('.js-right-sidebar').each(function () {

		this.rightsidebar = new RightSidebar(this);

	});

})(window, jQuery);
