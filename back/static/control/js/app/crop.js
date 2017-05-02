(function (window, $, undefined) {

	window.Crop = function (element, aspectRatio, value, callback) {

		var self = this;

		var $target = $(element);

		if ( ! callback) {

			callback = value;
			value = null;
		}

		this.$target = $target;

		this.$target.cropper({
			checkImageOrigin: false,
			aspectRatio: aspectRatio,
			autoCropArea: 1,
			data: value,
			strict: true,
			highlight: true,
			dragCrop: false,
			movable: true,
			resizable: true,
			rotatable: false,

			built: function () {

				$target.trigger('crop-ready');
			},

			crop: function (data) {

				callback(data.x, data.y, data.width, data.height);
			}
		});

	}

	window.Crop.prototype.setData = function (data) {

		this.$target.cropper('setData', data);

	};

	window.Crop.prototype.setAspectRatio = function (data) {

		this.$target.cropper('setAspectRatio', data);

	};

})(window, jQuery);
