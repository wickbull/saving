(function (window, $, undefined) {

	$('.js-attachment-attachable-area').each(function () {

		var $this      = $(this);
		var $container = $this.find('.js-attachment-attachable-container');

		var createAttachmentElement = function (id, name, url) {

			var $block   = $('<div/>', {'class': 'list-group-item clearfix js-item'});
			var $link    = $('<a/>', {'href': url, 'text': name}).appendTo($block);

			var $buttons = $('<div/>', {'class': 'pull-right'}).appendTo($block);
			$('<a/>', {'class': 'btn btn-default btn-sm m-r-xs js-item-destroy', 'href': '#', 'text': App.i18n('Delete'), 'target': '_blank'}).appendTo($buttons);

			$('<input>', {'type': 'hidden', 'name': 'attachment[]', 'class': 'js-item-id-val', 'value': id}).appendTo($block);

			$container.append($block);
		};

		$container.on('data-update', function (e, data) {

			console.log(data);

			createAttachmentElement(data.id, data.name, data.url);
		});

		// $container.sortable({
		// 	forcePlaceholderSize: true,
		// 	forceHelperSize: true,
		// 	containment: App.$contentBody,
		// 	appendTo: 'body',
		// 	helper: 'clone',
		// 	zIndex: 100
		// });

		$this.droppable({

			hoverClass: "bobbinet",

			accept: function ($item) {
				return ! $item.parent().is($container);
			},

			drop: function (e, ui) {

				var $draggable = $(ui.draggable);

				var url  = $draggable.data('url');
				var id   = $draggable.data('id');
				var name = $draggable.data('name');

				createAttachmentElement(id, name, url);
			}

		});

		$container.on('click', '.js-item-destroy', function (e) {

			e.preventDefault();

			if (confirm(App.i18n('Delete?'))) {
				$(this).closest('.js-item').remove();
			}
		});

	});


})(window, jQuery);
