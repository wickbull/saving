(function (window, $, undefined) {

	var preparePhoto = function (url, aspectRatio, cropValue, isWatermark, done) {

		var $img = $('<img>', {'src': url, 'class': 'img-thumbnail'});

		var $watermark = $('<input>', parseInt(isWatermark) ? {'type': 'checkbox',
			'checked': true} : {'type': 'checkbox'});

		var data = {};

		App.modal({

			title: 'Prepare photo',

			prepare: function ($body, $submit, options) {

				$submit.addClass('disabled');

				$submit.parent().prepend($('<div/>', {'class': 'checkbox pull-left'}).append(
					$('<label/>', {'text': App.i18n('Watermark')}).prepend($watermark)));

				App.require(['crop'], function () {

					$submit.removeClass('disabled');

					var cm = cropValue.match(/^(\d+)x(\d+)-(\d+)x(\d+)$/);

					var value = cm ? {x: parseInt(cm[1]), y: parseInt(cm[2]), width: parseInt(cm[3]),
						height: parseInt(cm[4]), rotate: 0} : null;

					var crop = new window.Crop($img, aspectRatio, value, function (x, y, w, h) {
						data.crop_x = Math.floor(x);
						data.crop_y = Math.floor(y);
						data.crop_w = Math.floor(w);
						data.crop_h = Math.floor(h);
					});

				});

				$img.appendTo($body);
			},

			submit: function ($body, $submit, closeCallback) {

				data.watermark = $watermark.is(':checked');

				done(data);

				closeCallback();
			}
		});

	};

	var editItem = function (title, descr, done) {

		var data = {};

		App.modal({

			title: 'Edit',

			prepare: function ($body, $submit, options, triggerSubmit) {

				var $form = $('<form/>');

				var $titleGroup = $('<div/>', {'class': 'form-group'}).appendTo($form);
				$('<label/>', {'for': 'edit-title-field', 'text': App.i18n('Title')}).appendTo($titleGroup);
				$('<input/>', {'type': 'title', 'class': 'form-control', 'id': 'edit-title-field', 'placeholder': App.i18n('Enter title')}).
					appendTo($titleGroup).val(title);

				var $descrGroup = $('<div/>', {'class': 'form-group'}).appendTo($form);
				$('<label/>', {'for': 'edit-descr-field', 'text': App.i18n('Description')}).appendTo($descrGroup);
				$('<input/>', {'type': 'descr', 'class': 'form-control', 'id': 'edit-descr-field', 'placeholder': App.i18n('Enter description')}).
					appendTo($descrGroup).val(descr);

				$form.append($('<input/>', {'type': 'submit', 'class': 'hide'}));

				$form.on('submit', function (e) {
					e.preventDefault();

					triggerSubmit();
				});

				$form.appendTo($body);
			},

			submit: function ($body, $submit, closeCallback) {

				done({
					title: $body.find('#edit-title-field').val(),
					descr: $body.find('#edit-descr-field').val()
				});

				closeCallback();
			},

			show: function ($body, $submit) {

				$body.find('input:first').focus();
			}
		});

	};


	$('.js-gallery-attachable-area').each(function () {

		var $this      = $(this);
		var $container = $this.find('.js-gallery-attachable-container');

		var createGalleryElement = function (imgId, imgSrc) {

			var $block   = $('<div/>', {'class': 'col-md-4 js-item'});
			var $wrapper = $('<div/>', {'class': 'thumbnail m-t-sm m-b-sm'}).appendTo($block);
			var $img_bg  = $('<div/>', {'class': 'thumbnail text-center bg-light m-b-xxs'}).appendTo($wrapper);
			$('<img/>', {'src': imgSrc}).appendTo($img_bg).css('height', '200px');

			var $caption = $('<div/>', {'class': 'caption'}).appendTo($wrapper);
			$('<h4/>', {'class': 'text-ellipsis js-item-title', 'text': '-'}).appendTo($caption);
			$('<p/>', {'class': 'text-ellipsis js-item-descr', 'text': '-'}).appendTo($caption);

			var $buttons = $('<p/>').appendTo($caption);
			$('<a/>', {'class': 'btn btn-primary btn-sm m-r-xs js-item-edit', 'href': '#', 'text': App.i18n('Edit')}).appendTo($buttons);
			$('<a/>', {'class': 'btn btn-primary btn-sm m-r-xs js-item-crop', 'href': '#'}).append($('<i/>', {'class': 'fa fa-crop'})).appendTo($buttons);
			$('<a/>', {'class': 'btn btn-default btn-sm m-r-xs js-item-destroy', 'href': '#', 'text': App.i18n('Delete')}).appendTo($buttons);

			$('<input>', {'type': 'hidden', 'name': 'gallery[generic_file_id][]', 'class': 'js-item-val', 'value': imgId}).appendTo($block);
			$('<input>', {'type': 'hidden', 'name': 'gallery[title][]', 'class': 'js-item-title-val' }).appendTo($block);
			$('<input>', {'type': 'hidden', 'name': 'gallery[descr][]', 'class': 'js-item-descr-val'}).appendTo($block);
			$('<input>', {'type': 'hidden', 'name': 'gallery[crop][]', 'class': 'js-item-crop-val'}).appendTo($block);
			$('<input>', {'type': 'hidden', 'name': 'gallery[watermark][]', 'class': 'js-item-watermark-val'}).appendTo($block);
			$('<input>', {'type': 'hidden', 'name': 'gallery[id][]', 'class': 'js-item-id-val'}).appendTo($block);

			$container.append($block);
		};

		$container.on('data-update', function (e, data) {
			createGalleryElement(data.id, data.url);
		});

		$container.sortable({
			forcePlaceholderSize: true,
			forceHelperSize: true,
			containment: App.$contentBody,
			appendTo: 'body',
			helper: 'clone',
			zIndex: 100
		});

		$this.droppable({

			hoverClass: "bobbinet",

			accept: function ($item) {
				return ! $item.parent().is($container);
			},

			drop: function (e, ui) {

				var imgSrc = $(ui.draggable).find('img').attr('src');
				var imgId  = $(ui.draggable).find('.js-storage-field-value').val();

				createGalleryElement(imgId, imgSrc);
			}

		});

		$container.on('click', '.js-item-destroy', function (e) {

			e.preventDefault();

			if (confirm('Delete?')) {
				$(this).closest('.js-item').remove();
			}
		});

		_({'img': 'dblclick', '.js-item-crop': 'click'}).each(function (events, selector) {

			$container.on(events, selector, function (e) {

				var $this  = $(this);

				var $crop  = $this.closest('.js-item').find('.js-item-crop-val');
				var $wmark = $this.closest('.js-item').find('.js-item-watermark-val');

				var imgSrc = $this.closest('.js-item').find('img').attr('src');

				e.preventDefault();

				preparePhoto(imgSrc, null, $crop.val(), $wmark.val(), function (data) {

					$wmark.val(data.watermark ? 1 : 0);

					$crop.val(data.crop_x + 'x' + data.crop_y + '-' + data.crop_w + 'x' + data.crop_h);
				});
			});
		});

		_({'.js-item-title, .js-item-descr': 'dblclick', '.js-item-edit': 'click'}).each(function (events, selector) {

			$container.on(events, selector, function (e) {

				var $this  = $(this);

				var $title = $this.closest('.js-item').find('.js-item-title');
				var $descr = $this.closest('.js-item').find('.js-item-descr');

				var $titleVal = $this.closest('.js-item').find('.js-item-title-val');
				var $descrVal = $this.closest('.js-item').find('.js-item-descr-val');

				e.preventDefault();

				editItem($title.text(), $descr.text(), function (data) {

					$title.text(data.title || '-');
					$descr.text(data.descr || '-');

					$titleVal.val(data.title);
					$descrVal.val(data.descr);
				});
			});
		});

	});


})(window, jQuery);
