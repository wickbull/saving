(function (window, $, undefined) {

	var Datepicker = function (element) {

		var $target = $(element);

		this.$target = $target;

		this.format = this.$target.data('format') || 'DD.MM.YYYY';

		// init

		this.$target.daterangepicker({
			showDropdowns: true,
			format: this.format,
			singleDatePicker: true,
			timePickerIncrement: 1,
			timePicker12Hour: false,
			timePicker: this.$target.data('timepick'),
			drops: this.$target.data('drops') || 'down',
		});

		// select current time

		this.$target.on('show.daterangepicker', function (e, picker) {

			if (!$target.val()) {

				picker.container.find('.hourselect').val((new Date).getHours()).trigger('change');

				var currentMinute = (new Date).getMinutes();

				var $minutes = picker.container.find('.minuteselect');

				var availableMinutes = _.map($minutes.first().find('option'), function(element) {

					return parseInt($(element).val());

				});

				var slectedMinute = _.filter(availableMinutes, function (element) {

					return element >= currentMinute;

				}).shift();

				$minutes.val(slectedMinute === undefined ? availableMinutes.pop() : slectedMinute).trigger('change');
			}
		});

	}

	Datepicker.prototype.setDateFormat = function (format) {

		this.format = format;

	};

	$('.js-datepicker').each(function () {

		this.datepicker = new Datepicker(this);

	});

})(window, jQuery);
