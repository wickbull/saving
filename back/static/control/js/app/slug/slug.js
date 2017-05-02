(function (window, $, undefined) {

	var Sluggable = function (element) {

		var self = this;

		this.$target = $(element);
		this.$source = $(this.$target.attr('data-source'));
		this.$locker = $(this.$target.attr('data-locker'));
		this.$status = $(this.$target.attr('data-check-status'));

		this.currentValue    = this.$target.val();
		this.checkRequestUrl = this.$target.attr('data-check');
		this.currentStatus   = 'empty';

		this.sendCheckRequest = _.debounce(this.sendCheckRequest, 500);

		// events

		this.$target.on('keydown keyup', function () {

			// enable manual mode
			// when edit manually

			if (!self.$locker.is(':checked') && self.$target.val() !== self.currentValue) {
				self.$locker.prop('checked', true);
			}

			self.check(self.getCorrectValue());

		});

		this.$source.on('input', function () {

			if (!self.$locker.filter(':checked').length) {

				var slug = getSlug($(this).val(), {
					lang: App.currentLang()
				});

				self.$target.val(slug).trigger('change');

				self.check(slug);
			}

		});

		if (this.currentStatus == 'empty' && this.$target.val().length > 2) {
			this.$locker.prop('checked', true);
		}

		// init

		if (this.$source.val()) {
			this.currentStatus = 'edit';
			this.$locker.prop('checked', true);
		}
	};

	Sluggable.prototype.getCorrectValue = function () {

		var rawValue = this.$target.val();
		var correctedValue = rawValue.toLowerCase().replace(/[^a-z\d\-\_]/, '');

		if (rawValue !== correctedValue) {
			this.$target.val(correctedValue);
		}

		return correctedValue;

	};

	Sluggable.prototype.updateStatus = function (status) {

		if (this.currentStatus !== status) {

			this.currentStatus = status;

			switch (status) {

				case 'edit':

					return this.$status.attr('class', 'input-group-addon')
						.find('i').attr('class', 'fa fa-pencil');

				case 'empty':

					return this.$status.attr('class', 'input-group-addon')
						.find('i').attr('class', 'fa fa-pencil text-muted');

				case 'error':

					return this.$status.attr('class', 'input-group-addon bg-danger b-danger')
						.find('i').attr('class', 'fa fa-remove');

				case 'checking':

					return this.$status.attr('class', 'input-group-addon')
						.find('i').attr('class', 'fa fa-cog fa-spin');

				case 'success':

					return this.$status.attr('class', 'input-group-addon bg-success b-success')
						.find('i').attr('class', 'fa fa-check');

				case 'exception':

					return this.$status.attr('class', 'input-group-addon')
						.find('i').attr('class', '');

			}
		}

	};

	Sluggable.prototype.sendCheckRequest = function (value) {
		var self = this;

		if (!value) {
			return false;
		}

		self.updateStatus('checking');

		$.ajax({
			url: this.checkRequestUrl,
			data: {
				'slug': value
			},
			success: function (data) {
				if (data.slug === self.currentValue) {
					if (data.exists) {
						self.updateStatus('error');
					} else {
						self.updateStatus('success');
					}
				}
			},
			error: function () {
				self.updateStatus('exception');
			}
		});

		return true;
	};

	Sluggable.prototype.check = function (value) {

		if (this.currentValue !== value && this.checkRequestUrl) {

			this.currentValue = value;

			this.updateStatus(value ? 'edit' : 'empty');

			this.sendCheckRequest(this.currentValue);
		}

	};

	$('.js-slug').each(function () {

		this.sluggable = new Sluggable(this);

	});

})(window, jQuery);
