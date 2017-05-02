(function (window, $, undefined) {

	var Related = function (element) {

		console.debug('creating Related obj');

		var self = this;

		this.$target     = $(element);
		this.$container  = $(this.$target.data('container'));
		this.$tab        = $(this.$target.data('tab'));
		this.$formTarget = $(this.$target.data('form-target'));
		this.url         = this.$target.data('url');
		this.$searchForm = this.$target.find('.js-related-search-form');

		var url = self.url;

		this.$tab.removeClass('hide').hide().fadeIn();

		if (self.$container.data('id'))
			url += '?exclude_id=' + self.$container.data('id');


		this.$tab.one('shown.bs.tab', function () {

			self.$tab.off('shown.bs.tab');

			console.debug('applied jquery one() to Related tab');

			self.showPreloader('loading');

			self.$container.load(url, function () {
				console.debug('trigger changeContent');
				self.$container.trigger('changeContent');
			});
		});

		this.$container.on('change', '.js-add-to-related', function () {
			var $this = $(this);
			var $item = $this.closest('li');

			if ($this.is(':checked')) {
				self.addToForm($item.clone());
			} else {
				self.removeFromForm($item.data('id'));
			}
		});

		this.$formTarget.on('change', '.js-add-to-related', function () {
			var $this = $(this);
			var $item = $this.closest('li');

			self.removeFromForm($item.data('id'));
		});


		this.$container.on('changeContent', function () {
			var $formUl = self.$formTarget;
			var $ul = self.$container.find('ul').first();

			$formUl.find("li").each(function(index) {
				var id = $(this).data('id');
				if ($ul.find('li[data-id=' + id + ']').length) {
					$ul.find('li[data-id=' + id + '] input[type=checkbox]').prop('checked', true);
				}
			});
		})

		this.$searchForm.on('submit', function (e) {
			e.preventDefault();

			var $form = $(this);
			self.showPreloader('loading');

			self.$container.load(this.action + '?' + $form.serialize(), function () {
				console.debug('trigger changeContent');
				self.$container.trigger('changeContent');
			});
		})

	};

	Related.prototype.addToForm = function ($el) {
		this.$formTarget.append($el).hide().fadeIn();
		console.debug('add to related');
		this.$formTarget.parent().find('.js-nothing-in-related').hide();
	};

	Related.prototype.removeFromForm = function (id) {
		var $formLi = this.$formTarget.find('[data-id=' + id + ']');
		var self = this;

		console.debug('remove from related');

		$formLi.fadeOut(function () {
			this.remove();

			if (! self.$formTarget.find('[data-id]').length) {
				self.$formTarget.parent().find('.js-nothing-in-related').removeClass('hide').hide().fadeIn();
			}
		});

		var $checkbox = this.$container.find('[data-id=' + id + '] input[type=checkbox]');
		$checkbox.prop('checked', false);
	}

	Related.prototype.showPreloader = function (text) {

		this.$container.html($('<div/>', {'class': 'text-muted text-center wrapper', 'text': ' ' + text})
				.prepend($('<i/>', {'class': 'fa fa-cog fa-spin'})));
	};

	$('.js-related-selector').each(function () {

		this.related = new Related(this);

	});


})(window, jQuery);
