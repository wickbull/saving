(function (window, $, undefined) {

	var dragDataTransfer;

	jQuery.fn.dragthis = function (_options) {

		this.each(function () {

				var $this = $(this);

				var options = $.extend({
					selector: null,
					hoverClass: null,
					eachPrepare: null
				}, _options);

				$this.on('dragstart', options.selector, function (e) {

					dragDataTransfer = _.clone($(this).closest(options.selector || $this).data());

					e.originalEvent.dataTransfer.setData('dragthis', true);

					if (options.eachPrepare) {
						dragDataTransfer = options.eachPrepare(dragDataTransfer);
					}

					// disable drag img and a

					if (['A', 'IMG'].indexOf($(e.target).prop('tagName')) >= 0) {
						e.preventDefault();
					};

				});
		});

	};

	jQuery.fn.draghere = function (_options) {

		this.each(function () {

				var $this = $(this);

				var options = $.extend({
					selector: null,
					hoverClass: null,
					bottomHoverClass: null
				}, _options);

				var bottomPosition;

				// accept

				$this.on('dragover', options.selector, function (e) {

					var $target = $(e.target).closest(options.selector || $this);
					var height  = $target.height();

					e.preventDefault();

					if (options.bottomHoverClass) {
						bottomPosition = e.originalEvent.offsetY > height / 2;

						$target[bottomPosition ?
							'addClass' : 'removeClass'](options.bottomHoverClass);
					}

				});

				// drop

				$this.on('drop', function (e) {

					var isDragThis = e.originalEvent.dataTransfer.getData('dragthis');
					var $target    = $(e.target).closest(options.selector || $this);

					e.preventDefault();

					$target
						.removeClass(options.hoverClass)
						.removeClass(options.bottomHoverClass);

					if (isDragThis && options.drop) {
							options.drop($target, dragDataTransfer, bottomPosition);
					}

				});

				// hover

				if (options.hoverClass) {

					var lastenter;

					$this.on('dragenter', options.selector, function (e) {
						var $target = $(e.target).closest(options.selector || $this);

						$target.parent().find(options.selector)
							.removeClass(options.hoverClass)
							.removeClass(options.bottomHoverClass);

						lastenter = e.target;

						$target.addClass(options.hoverClass);
					});


					$this.on('dragleave', function (e) {
						var $target = $(e.target).closest(options.selector || $this);

						if (lastenter === e.target) {
							$target
								.removeClass(options.hoverClass)
								.removeClass(options.bottomHoverClass);
						}
					});

				}
		});

	};



})(window, jQuery);
