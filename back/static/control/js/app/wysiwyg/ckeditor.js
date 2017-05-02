(function (window, $, undefined) {

	var $floatingBlockInstance;

	var getFloatingBlock = function (textarea) {

		if ($floatingBlockInstance) {
			return $floatingBlockInstance;
		}

		$floatingBlockInstance = $('<div/>', {'class': 'bg-light lter wrapper-xs b-b wysiwyg-toolbar-container hide', 'id': 'js-wysiwyg-toolbar-container'})
				.insertBefore($(textarea).closest('.row-row'));

		return $floatingBlockInstance;
	};

	var makeImageUrl = function (apiCrop, data, watermark, callback) {

		$.ajax({
			url: apiCrop,
			type: 'GET',
			data: {
				r: data.w + 'x',
				c: data.crop_x + 'x' + data.crop_y + '-' + data.crop_w + 'x' + data.crop_h,
				watermark: watermark ? 1 : 0
			},
			success: function (data) {

				callback(data.url);
			}
		});

	};

	var preparePhoto = function (apiCrop, url, id, aspectRatio, maxWidth, maxHeight, done) {

		var $img = $('<img>', {'src': url, 'class': 'img-thumbnail'});

		var data = {
			id: parseInt(id),
			w : parseInt(maxWidth)  || null,
			h : parseInt(maxHeight) || null
		};

		var isCancelled = false;

		var $buttonsContainer = $(_.template(
			'<div class="btn-group pull-left" data-toggle="buttons">' +
				'<label class="btn btn-default <% if (watermarkChecked) print("active") %>">' +
					'<i class="fa fa-paint-brush m-r-sm"></i>' +
					'<%= watermark %>' +
					'<input type="checkbox" autocomplete="off" class="js-watermark-button" <% if (watermarkChecked) print("checked") %> >' +
				'</label>' +
				'<label class="btn btn-default <% if (aspectRatioChecked) print("active") %>">' +
					'<i class="glyphicon glyphicon-resize-full m-r-sm m-r-sm"></i>' +
					'<%= aspectRatio %>' +
					'<input type="checkbox" autocomplete="off" class="js-ar-button" <% if (aspectRatioChecked) print("checked") %> >' +
				'</label>' +
			'</div>'
		)({
			watermark: App.i18n('Watermark'),
			aspectRatio: App.i18n('Aspect ratio'),
			watermarkChecked: localStorage.watermarkChecked,
			aspectRatioChecked: localStorage.aspectRatioChecked,
		}))
		.hide();

		var $watermark   = $buttonsContainer.find('.js-watermark-button').on('change', function () {
			localStorage.watermarkChecked = $(this).is(':checked') ? true : '';
		});

		var $aspectRatio = $buttonsContainer.find('.js-ar-button').on('change', function () {
			localStorage.aspectRatioChecked = $(this).is(':checked') ? true : '';
		});

		App.modal({

			title: App.i18n('Prepare photo'),

			prepare: function ($body, $submit, options) {

				$submit.addClass('disabled');
				$body.addClass('bobbinet');

				$submit.parent().prepend($buttonsContainer);

				App.require(['crop'], function () {

					$buttonsContainer.fadeIn();
					$submit.removeClass('disabled');
					$body.removeClass('bobbinet');

					var crop = new window.Crop($img, $aspectRatio.is(':checked') ?
						aspectRatio : null, function (x, y, w, h) {
							data.crop_x = Math.floor(x);
							data.crop_y = Math.floor(y);
							data.crop_w = Math.floor(w);
							data.crop_h = Math.floor(h);
					});

					$aspectRatio.on('change', function () {
						crop.setAspectRatio($(this).is(':checked') ?
							aspectRatio : null);
					});

				});

				$img.appendTo($body);
			},

			submit: function ($body, $submit, closeCallback) {

				if ($submit.hasClass('disabled')) {
					return false;
				}

				var initialSubmitText = $submit.html();

				$submit.addClass('disabled').prepend($('<i/>', {
					'class': 'fa fa-cog fa-spin m-r-xs'
				}));

				$body.addClass('bobbinet');

				makeImageUrl(apiCrop, data, $watermark.is(':checked'), function (url) {

					if (!isCancelled && url) {

						done(url);

						closeCallback();
					}

					$body.removeClass('bobbinet');

					$submit.removeClass('disabled').html(initialSubmitText);

				});

			},

			cancel: function () {

				isCancelled = true;
			}
		});

	};


	var getDroppedHtmlByObject = function (data, callback) {

		var $tmpContainer = $('<div/>');

		if (!data.isImage)
			return callback('<a href="' + data.url + '">' + data.name + '</a>');


		if (data.cropUrl)
			return preparePhoto(data.cropUrl, data.url, data.id, data.imgAspectRatio,
				data.imgMaxWidth, data.imgMaxHeight, function (url) {

					$tmpContainer.empty()
						.append($('<img>', { 'src': url, 'alt': data.descr }))
						.append($('<br/>'))
						.append($('<i/>', { 'text': data.descr}))
					;

					callback($tmpContainer.html());
			});

		$tmpContainer.empty()
			.append($('<img>', { 'src': data.url, 'alt': data.descr }))
			.append($('<br/>'))
			.append($('<i/>', { 'text': data.descr }))
		;

		return callback($tmpContainer.html());
	}


	CKEDITOR.on('instanceCreated', function (ev) {

		var editor = ev.editor;
		var $textarea = $(editor.element.$);

		var imgAspectRatio = $textarea.data('img-aspect-ratio') || (4 / 3);
		var imgMaxWidth    = $textarea.data('img-max-width')    || 800;
		var imgMaxHeight   = $textarea.data('img-max-height')   || 2000;


		editor.on('contentDom', function() {

			$(editor.document.$).draghere({
				selector: 'p',
				hoverClass: 'bobbinet',
				bottomHoverClass: 'bobbinet-bottom',
				drop: function ($target, data, isBottom) {

					if (data) {
						data.imgAspectRatio = imgAspectRatio;
						data.imgMaxWidth    = imgMaxWidth;
						data.imgMaxHeight   = imgMaxHeight;

						getDroppedHtmlByObject(data, function (html) {

							if ($target.length) {
								$target[isBottom ? 'after' :
									'before']('<p>' + html + '</p>');
							} else {
								$(editor.document.$.body).children().last()[isBottom ? 'after' :
									'before']('<p>' + html + '</p>');
							}

							editor.focus();
						});
					}

				}
			});

		});

	});

	$('.js-wysiwyg').each(function () {

		var config = {};

		config.sharedSpaces = { top: getFloatingBlock(this).attr('id') };

		CKEDITOR.replace(this, _.extend({
			customConfig: App.staticHost + 'js/app/wysiwyg/ckeditor.config.js'}, config));

	});

	CKEDITOR.on('instanceReady', function (ev) {

		var editor = ev.editor;
		var $textarea = $(editor.element.$);

		editor.on('focus', function () {
			getFloatingBlock(editor.element.$).hide().removeClass('hide').fadeIn();
		});

		editor.on('blur', function () {
			getFloatingBlock(editor.element.$).addClass('hide');
		});

		editor.on('change', _.debounce(function () {
			this.updateElement();

			$textarea.trigger('change');
		}, 1000));


		// Ends self closing tags the HTML4 way, like <br>.
		ev.editor.dataProcessor.htmlFilter.addRules(
		{
			elements:
			{
				$: function (element) {
					// Output dimensions of images as width and height
					if (element.name == 'img') {
						var style = element.attributes.style;

						if (style) {
							// Get the width from the style.
							var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
								width = match && match[1];

							// Get the height from the style.
							match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
							var height = match && match[1];

							if (width) {
								element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
								element.attributes.width = width;
							}

							if (height) {
								element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
								element.attributes.height = height;
							}
						}
					}



					if (!element.attributes.style)
						delete element.attributes.style;

					return element;
				}
			}
		});

	});

})(window, jQuery);
