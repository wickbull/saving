(function (window, $, undefined) {

	var apiListUrl   = App.baseHost + 'storage/ajax/:id';

	var apiUploadUrl = App.baseHost + 'storage/:id/upload';

	var apiMkDirUrl  = App.baseHost + 'storage/:id/mkdir';

	var apiURoot     = App.baseHost + 'storage/root/unassigned';

	var apiCrop      = App.baseHost + 'storage/file/:id/url';

	var apiUpdate    = App.baseHost + 'storage/file/:id/update';

	// event emitter

	var EventEmitter = function () {};

	EventEmitter.prototype.on = function (event, fct) {

		this._events = this._events || {};
		this._events[event] = this._events[event] || [];
		this._events[event].push(fct);
	};

	EventEmitter.prototype.off = function (event, fct) {

		this._events = this._events || {};
		if(event in this._events === false)	return;
		this._events[event].splice(this._events[event].indexOf(fct), 1);
	};

	EventEmitter.prototype.trigger = function (event, fct) {

		this._events = this._events || {};
		if(event in this._events === false)	return;
		for(var i = 0; i < this._events[event].length; i++) {
			this._events[event][i].apply(this, Array.prototype.slice.call(arguments, 1));
		}
	};

	// uploader

	var Uploader = function (element, apiUploadUrl, apiMkDirUrl, apiURoot) {

		var self = this;

		this.$target      = $(element);
		this.$btn         = this.$target.closest('.btn');

		this.apiUploadUrl = apiUploadUrl;
		this.apiMkDirUrl  = apiMkDirUrl;
		this.apiURoot     = apiURoot;

		this.group        = this.$target.data('control-group');

		this.base_root_id = null;

		if (this.group) {
			if (!App.controlGroup[this.group]) {
				App.controlGroup[this.group] = [];
			}

			App.controlGroup[this.group].push(this);
		}

		// view list object

		this.listView = this.getListView(
			this.$target.data('list-display'), apiListUrl, function (id) {

			// update upload target id from navigation

			self.updateCurrentId(id);

			self.broadcastGroup(function (uploader) {
				uploader.updateCurrentId(id);
			});
		});

		this.on('id-change', function (id) {

			self.listView.updateCurrentId(id);
		});

		// view progress object

		this.progressView = this.getProgressView(
			this.$target.data('progress-display'));

		// display data object

		this.displayData = new UploaderDisplayData(this.$target.data('display-data'));

		setTimeout(function () { self.displayData.display(null); });


		this.readyWaitCallbacks = [];

		this.$createDir       = $(this.$target.data('create-dir'));
		this.path             = this.$target.data('path');
		this.fileupload       = this.initFileuploader(this.$target.closest('.js-dropzone'));

		if (this.$target.data('assign')) {
			this.assignToForm(this.$target.data('assign'));
		}

		if (this.getCurrentId()) {

			this.broadcastGroup(function (uploader) {
				uploader.updateCurrentId(self.getCurrentId());
			});

			this.listView.showPreloader('loading');
		}

		// dir create

		this.$createDir.on('click', function (e) {
			var dirname = prompt(App.i18n('Enter directory name'), '');

			e.preventDefault();

			if (dirname != null) {
				self.createDir(dirname, self.path, $(this));
			}
		});

		// display initial list on show
		var $tabButton = $('.js-sidebar-storage-tab-button');

		if ($tabButton.hasClass('hide')) {
			$tabButton.removeClass('hide').hide().fadeIn().on('show.bs.tab', function () {
				self.listView.init();
			});
		}

	};

	Uploader.prototype = Object.create(EventEmitter.prototype);

	Uploader.prototype.constructor = Uploader;

	Uploader.prototype.setCurrentId = function (id) {

		this.updateCurrentId(id);

		this.trigger('id-change', id);
	};

	Uploader.prototype.updateCurrentId = function (id) {

		if (!this.base_root_id) {
			this.base_root_id = id;
		}

		this.$target.data('id', id).attr('data-id', id);
	};

	Uploader.prototype.getCurrentId = function () {

		return this.$target.data('id');
	};

	Uploader.prototype.getUrlUpload = function () {

		if (this.path) {
			return this.apiUploadUrl.replace(':id', this.base_root_id);
		}

		return this.apiUploadUrl.replace(':id', this.getCurrentId());
	};

	Uploader.prototype.getUrlMkDir = function () {
		return this.apiMkDirUrl.replace(':id', this.getCurrentId());
	};

	Uploader.prototype.getUrlURoot = function () {
		return this.apiURoot.replace(':id', this.getCurrentId());
	};

	Uploader.prototype.getListView = function (selector, apiUrl, idChangeCallback) {

		return $(selector).prop('uploaderListView') ||
			new UploaderListView(selector, apiUrl, idChangeCallback);
	};

	Uploader.prototype.getProgressView = function (selector) {

		return $(selector).prop('uploaderProgressView') ||
			new UploaderProgressView(selector);
	};

	Uploader.prototype.broadcastGroup = function (callback) {

		var self = this;

		(App.controlGroup[this.group] || []).forEach(function (uploader) {
			if (uploader && uploader !== self) {
				callback(uploader);
			}
		});
	};

	Uploader.prototype.assignToForm = function (id) {

		$('#storage-form-assign').val(id);

	};

	Uploader.prototype.initFileuploader = function (dropZone) {

		var self = this;

		return this.$target.fileupload({

			dropZone: dropZone,

			dataType: 'json',

			beforeSend: function(xhr) {
				xhr.setRequestHeader('X-XSRF-TOKEN', App.getToken());

				self.listView.lock();
			},

			add: function (e, data) {
				self.readyQueue(function (url) {

					data.url = url;

					if (self.path) {
						data.formData = {
							path: self.path
						};
					}

					data.files.forEach(function (file) {
						file.context = new UploadableFile(self.progressView, self.listView, self.displayData, file);
					});

					data.submit();

				});
			},

			done: function (e, data) {
				data.files.forEach(function (file) {
					file.context.done(data.result);
				});
			},

			fail: function (e, data) {
				data.files.forEach(function (file) {
					file.context.fail();
				});
			},

			progress: function (e, data) {
				data.files.forEach(function (file) {
					file.context.progress(parseInt(data.loaded / data.total * 100, 10));
				});
			},

			progressall: function (e, data) {

				// all complete

				// if (data.loaded  === data.total) {
				// 	self.listView.refresh();
				// }

			}
		});
	};

	Uploader.prototype.createDir = function (name, path, $control) {

		var self = this;

		if ($control.hasClass('disabled')) {

			return false;
		}

		$control.addClass('disabled');

		this.readyQueue(function () {

			$.ajax({
				url: self.getUrlMkDir(),
				data: {
					name: name,
					description: name,
					path: path
				},
				type: 'POST',
				beforeSend: function(xhr) {

					xhr.setRequestHeader('X-XSRF-TOKEN', App.getToken());
				},
				success: function () {

					self.listView.refresh();

					$control.removeClass('disabled');
				},
				error: function () {

					$control.removeClass('disabled');

					App.showMessage({'type': 'danger', 'title': App.i18n('Error'), 'body': App.i18n('Create directory error, try again later')});
				}
			});

		});
	};

	Uploader.prototype.isReady = function () {

		return !!this.getCurrentId();
	}

	Uploader.prototype.readyQueue = function (callback) {

		var self = this;

		if (this.isReady()) {

			return callback(this.getUrlUpload());
		}

		if (!this.readyWaitCallbacks.length) {

			this.listView.showPreloader('initializing');

			this.$btn.addClass('disabled');

			$.ajax(this.getUrlURoot())

				.done(function (data) {

					if (data.id) {

						self.setCurrentId(data.id);

						self.broadcastGroup(function (uploader) {
							uploader.setCurrentId(data.id);
						});

						self.assignToForm(data.id);

						self.readyWaitCallbacks.forEach(function (callback) {
							callback(self.getUrlUpload());
						});

					} else {
						App.showMessage({'type': 'danger', 'title': App.i18n('Error'), 'body': App.i18n('Storage error #1, try again later')});
					}
				})

				.fail(function () {

					App.showMessage({'type': 'danger', 'title': App.i18n('Error'), 'body': App.i18n('Storage error #2, try again later')});
				})

				.always(function() {
					self.readyWaitCallbacks = [];

					self.$btn.removeClass('disabled');
				})
			;

		}

		this.readyWaitCallbacks.push(callback);
	};


	// file

	var UploadableFile = function (progressView, listView, displayData, file) {

		this.listView     = listView;
		this.progressView = progressView;
		this.displayData  = displayData;

		this.$uploadingDisplay = $('<div/>').appendTo(progressView.getContainer().removeClass('hide'));

		this.$status = $('<span/>', {'class': 'pull-right text-xs'}).text('starting')
			.appendTo(this.$uploadingDisplay);

		this.$title = $('<p/>', {'class': 'm-b-xs'}).text(' ' + file.name)
			.appendTo(this.$uploadingDisplay);

		this.$cancel = $('<a/>').text('Cancel -')
			.prependTo(this.$title);

		this.$progressWrapper = $('<div/>', {'class': 'progress progress-xxs m-b-xs'})
			.appendTo(this.$uploadingDisplay);

		this.$progressBar = $('<div/>', {'class': 'progress-bar progress-bar-primary', 'style': 'width: 0'})
			.appendTo(this.$progressWrapper);

	};

	UploadableFile.prototype = Object.create(EventEmitter.prototype);

	UploadableFile.prototype.constructor = UploadableFile;

	UploadableFile.prototype.done = function (result) {

		var self = this;

		this.$status.text('success');
		this.$cancel.remove();
		this.$progressBar.removeClass('progress-bar-primary').addClass('progress-bar-success');

		this.displayData.display(result);

		this.listView.refresh();

		setTimeout(function () {
			self.$uploadingDisplay.fadeOut(function () {

				if ( ! self.$uploadingDisplay.siblings().length) {
					self.$uploadingDisplay.parent().addClass('hide');
				}

				self.$uploadingDisplay.remove();
			});
		}, 500);
	};

	UploadableFile.prototype.fail = function () {
		this.$cancel.remove();
		this.$status.text('failed');
		this.$progressBar.removeClass('progress-bar-primary').addClass('progress-bar-danger');
	};

	UploadableFile.prototype.progress = function (progress) {
		this.$status.text(progress + '%');
		this.$progressBar.css('width', progress + '%');
	};


	// ------------------------
	//  List View
	// ------------------------

	var UploaderListView = function (element, apiListUrl, idChangeEvent) {

		var self = this;

		this.$list = $(element);

		this.apiListUrl = apiListUrl;

		this.path = this.$list.data('path');

		this.isInited = false;

		this.$list.dragthis({
			selector: '.js-item-draggable',
			eachPrepare: function (data) {
				data.cropUrl = apiCrop.replace(':id', data.id);
				return data;
			}
		});


		// edit

		this.$list.on('click', '.js-edit', function (e) {

			var $this = $(this).closest('li');

			var id    = $this.data('id');

			e.preventDefault();

			App.prompt('Edit', {

				name: {
					title: 'Name',
					value: $this.data('name')
				},
				descr: {
					title: 'Descr',
					value: $this.data('descr')
				}

			}, function (result, $submit, closeCallback) {

				if ($submit.hasClass('disabled')) {
					return false;
				}

				$.ajax({
					url: apiUpdate.replace(':id', id),
					data: result,
					type: 'POST',
					beforeSend: function(xhr) {
						xhr.setRequestHeader('X-XSRF-TOKEN', App.getToken());

						$submit.addClass('disabled');
					},
					success: function () {
						closeCallback();

						self.refresh();
					},
					complete: function () {
						$submit.removeClass('disabled');
					}
				});

			});

		});

		// bind navigation

		this.$list.on('click', '.js-sidebar-storage-nav', function (e) {

			e.preventDefault();

			self.setCurrentId($(this).data('id'));

			self.refresh();
		});

		if (idChangeEvent) {
			this.on('id-change', idChangeEvent);
		}

		this.$list.prop('uploaderListView', this);
	};

	UploaderListView.prototype = Object.create(EventEmitter.prototype);

	UploaderListView.prototype.constructor = UploaderListView;

	UploaderListView.prototype.init = function () {

		if (!this.isInited) {
			this.isInited = true;
			this.refresh();
		}
	};

	UploaderListView.prototype.getUrl = function () {

		var url = this.apiListUrl.replace(':id', this.getCurrentId());

		if (this.path) {

			url += '?path=' + this.path;
		}

		return url;
	};

	UploaderListView.prototype.setCurrentId = function (id) {

		this.updateCurrentId(id);

		this.trigger('id-change', id);
	};

	UploaderListView.prototype.updateCurrentId = function (id) {

		this.$list.data('id', id).attr('data-id', id);
	};

	UploaderListView.prototype.getCurrentId = function () {

		return this.$list.data('id');
	};

	UploaderListView.prototype.refresh = function () {

		var self = this;

		if (this.getCurrentId()) {

			this.lock();

			this.$list.load(this.getUrl(), function () {

				self.unlock();

			});
		}


	};

	UploaderListView.prototype.showPreloader = function (text) {

		this.$list.html($('<div/>', {'class': 'text-muted text-center wrapper', 'text': ' ' + text})
				.prepend($('<i/>', {'class': 'fa fa-cog fa-spin'})));
	};

	UploaderListView.prototype.lock = function () {

		this.$list.css('opacity', '.5');
	};

	UploaderListView.prototype.unlock = function () {

		this.$list.css('opacity', '1');
	};

	// ------------------------
	//  Progress View
	// ------------------------

	var UploaderProgressView = function (element) {

		this.$container = $(element);

		this.$container.prop('uploaderProgressView', this);

	};

	UploaderProgressView.prototype = Object.create(EventEmitter.prototype);

	UploaderProgressView.prototype.constructor = UploaderProgressView;

	UploaderProgressView.prototype.getContainer = function () {

		return this.$container;
	};

	// ------------------------
	//  Display data
	// ------------------------

	var UploaderDisplayData = function (element) {

		this.$target = $(element);

	};

	UploaderDisplayData.prototype.display = function (data) {

		if (this.$target.hasClass('js-mass-upload-container')) {

			this.displayMassUpload(data);

		} else {

			this.displayWidget(data);

		}

	};

	UploaderDisplayData.prototype.displayWidget = function (data) {

		var self = this;

		this.$target.removeClass('hide').hide();

		if (!this.$target.length) {
			return false;
		}

		var $container = this.$target.find('.js-display-container').empty();

		if (data) {
			this.$target.find('.js-storage-field-value').val(data.id);

			// clear
			_.each(this.$target.data(), function (item, key) { self.$target.data(key, null); });

			// updaet data
			this.$target.data(data);
		}

		data = _.clone(this.$target.data());

		if (data.url) {

			if (data.isImage) {

				$container
					.append($('<img>', { 'src': data.thumb }))
					.addClass('after-overlay');

			} else {

				$container
					.removeClass('after-overlay')
					.append(
						$('<span/>', { 'text': data.name, 'class': 'text-ellipsis' })
							.prepend(
								$('<a/>', {'class': 'fa fa-file-o m-r-xs m-l-xs', 'href': data.url})
							)
					);

			}
		}

		if ($container.children().length) {

			this.$target
				.trigger('data-update', [true, this.$target])
				.fadeIn();

		} else {

			this.$target.trigger('data-update', [false, this.$target]);

		}
	};

	UploaderDisplayData.prototype.displayMassUpload = function (data) {
		return this.$target.trigger('data-update', [data]);
	};

	UploaderDisplayData.prototype.displayCropBox = function (cropValue, aspectRatio, done) {

		var $img = $('<img>', {'src': this.$target.data('url'), 'class': 'img-thumbnail'});
		var data = {};

		App.modal({

			title: 'Prepare photo',

			prepare: function ($body, $submit, options) {

				$submit.addClass('disabled');

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

				done(data);

				closeCallback();
			}
		});
	};

	$('.js-uploader').each(function () {

		$(this).parent()
			.removeClass('hide');

		this.uploader = new Uploader(this, apiUploadUrl,
			apiMkDirUrl, apiURoot);

	});

	// init storage widgets

	$('.js-storage-widget').each(function () {

		var $this = $(this);

		var $uploader = $this.find('.js-uploader');
		var $value    = $this.find('.js-storage-field-value');
		var $clear    = $this.find('.js-storage-widget-clear');
		var $crop     = $this.find('.js-storage-widget-crop');
		var uploader  = $uploader.get(0).uploader;

		var $smallImageAlert = $this.find('.js-small-image-alert');

		var required_width = parseInt($uploader.data('width'), 10) || null;
		var required_height = parseInt($uploader.data('height'), 10) || null;

		// hide controls if read only

		if ($this.hasClass('js-storage-widget-readonly')) {
			$uploader.parent().hide();

			return true;
		}

		$this.draghere({
			selector: '.js-item-droppable',
			hoverClass: 'bobbinet',
			drop: function ($target, data) {
				uploader.displayData.display(data);
			}
		});

		$this.dragthis({
			selector: '.js-item-draggable',
			eachPrepare: function (data) {
				data.cropUrl = apiCrop.replace(':id', data.id);
				return data;
			}
		});

		// clear button

		uploader.displayData.$target.on('data-update', function (e, isAvailable, $target) {

			$clear[isAvailable ? 'fadeIn' : 'hide']().removeClass('hide');

			var isImage = $target.data('is-image');
			var isSmallImage;
			var width;
			var height;


			if (isAvailable && isImage && required_width && required_height) {

				width = $target.data('width');
				height = $target.data('height');

				if (width < required_width || height < required_height) {
					isSmallImage = true;
					$smallImageAlert.find('.size').text(required_width + 'x' + required_height);
					$smallImageAlert.find('.real-size').text(width + 'x' + height);
				}

			}

			$crop[isAvailable && !isSmallImage && isImage ? 'fadeIn' : 'hide']().removeClass('hide');
			$smallImageAlert[isAvailable && isImage && isSmallImage ? 'removeClass' : 'addClass']('hide');

		});

		$clear.on('click', function (e) {
			e.preventDefault();
			uploader.displayData.display({});
		});

		$crop.find('a').on('click', function (e) {

			var $cropValueField = $crop.find('.js-storage-field-crop-value');

			e.preventDefault();

			uploader.displayData.displayCropBox($cropValueField.val(), required_width/required_height, function (data) {
				$cropValueField.val(data.crop_x + 'x' + data.crop_y + '-' + data.crop_w + 'x' + data.crop_h);
			});
		});

	});

})(window, jQuery);
