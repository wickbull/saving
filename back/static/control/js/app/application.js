(function (window, $, undefined) {

    // global variables

    App.$doc = $(document);

    App.$contentBody = App.$doc.find('.app-content-body:first');

    App.conf.loadTimeout = 30000;

    App.controlGroup = {};

    App.injectedFiles = [];

    App.translations = [];

    App.resetCacheKey = $('script[src*="/app-"]').attr('src').split('/').pop().match(/app-([\w]+)/)[1];

    // localStorage fallback

    if (!localStorage) {
        localStorage = {};
    }

    // application

    App.currentLang = function () {
        return $('html').attr('lang');
    };

    App.setLang = function ($lang) {
        App.transltaions = App.translate[$lang];
    };

    App.getToken = function () {

        return App.token_encrypted;
    };

    App.i18n = function (str) {
        // if (App.transltaions[str])
        // 	return App.transltaions[str];

        return str;
    };

    App.modal = function (options) {

        var $modalWrapper = $('<div/>', {'class': 'modal'});
        var $modalDialog  = $('<div/>', {'class': 'modal-dialog modal-lg'}).appendTo($modalWrapper);
        var $modalContent = $('<div/>', {'class': 'modal-content'}).appendTo($modalDialog);

        var $header = $('<div/>', {'class': 'modal-header'}).appendTo($modalContent);
        $('<button/>', {'class': 'close', 'type': 'button', 'data-dismiss': 'modal', 'aria-label': App.i18n('Close')}).
            append($('<span/>', {'aria-hidden': true, 'html': '&times;'})).
            appendTo($header);

        $('<h4/>', {'class': 'modal-title', 'text': options.title}).
            appendTo($header);

        var $body = $('<div/>', {'class': 'modal-body'}).appendTo($modalContent);

        var $footer = $('<div/>', {'class': 'modal-footer'}).appendTo($modalContent);

        $('<button/>', {'class': 'btn btn-default', 'type': 'button', 'data-dismiss': 'modal', 'text': App.i18n('Cancel')}).
            appendTo($footer);

        var $submit = $('<button/>', {'class': 'btn btn-primary', 'type': 'button', 'text': 'Ok'}).
            appendTo($footer).on('click', function () {
                if (options.submit) {
                    options.submit($body, $submit, function () {
                        $modalWrapper.modal('hide');
                    });
                }
            });

        $modalWrapper.on('hide.bs.modal', function (event) {

            if (options.cancel) {
                options.cancel();
            }

            $modalWrapper.remove();
        });

        if (options.prepare) {
            options.prepare($body, $submit, options, function () {
                $submit.trigger('click');
            });
        }

        $modalWrapper.modal('show');

        if (options.show) {
            options.show($body, $submit);
        }
    };

    App.prompt = function (title, fields, callback) {

        var fieldsControls = {};

        this.modal({

            title: title,

            prepare: function ($body, $submit, options) {

                var $form = $('<form/>').on('submit', function (e) {
                    e.preventDefault();

                    $submit.click();
                });

                $form.append($('<input/>', {'type': 'submit', 'class': 'hide'}));

                _.each(fields, function (data, index) {

                    var key = 'modal-prompt-field-' + index;

                    var $formGroup = $('<div/>', {'class': 'form-group'});

                    var $formLabel = $('<label/>', {'class': 'control-label', 'for': key, 'text': data.title || null })
                        .appendTo($formGroup);

                    var $formInput = $('<input/>', {'class': 'form-control', 'id': key, 'type': 'text', 'value': data.value || null })
                        .appendTo($formGroup);

                    fieldsControls[index] = $formInput;

                    $form.append($formGroup);
                });

                $form.appendTo($body);
            },

            show: function ($body, $submit) {
                $body.find('input:visible:first').focus();
            },

            submit: function ($body, $submit, closeCallback) {

                var data = {};

                _.each(fieldsControls, function ($input, index) {
                    data[index] = $input.val();
                });

                callback(data, $submit, closeCallback);
            }
        });

    };

    App.registerScript = function (namespace, scriptUrl) {

        // create namespace if not exists

        if (!App.scriptMap[namespace]) {
            App.scriptMap[namespace] = [];
        }

        // append to scriptMap, allowed array of scripts

        (_.isArray(scriptUrl) ? scriptUrl : [scriptUrl]).forEach(function (url) {
            App.scriptMap[namespace].push(App.staticHost + url);
        });

    };

    App.require = function (namespaces, callback, asynchronous) {

        var scripts = [];

        (_.isArray(namespaces) ? namespaces : [namespaces]).forEach(function (namespace) {

            if (typeof App.scriptMap[namespace] === 'undefined') {
                console.error(App.i18n('Namespace'), namespace, App.i18n(' not defined'));
            }

            App.scriptMap[namespace].forEach(function (url) {

                if (App.injectedFiles.indexOf(url) === -1) {
                    App.injectedFiles.push(url);

                    scripts.push(function (callback) {

                        if (url.match(/\.css$/)) {
                            yepnope.injectCss({
                                href: url+'?v=' + App.resetCacheKey,
                                attrs: {},
                                timeout: App.conf.loadTimeout
                            }, callback);
                        } else {
                            yepnope.injectJs({
                                src: url+'?v=' + App.resetCacheKey,
                                attrs: {},
                                timeout: App.conf.loadTimeout
                            }, callback);
                        }

                    });
                }

            });
        });

        async[asynchronous ? 'parallel' : 'series'](scripts, function (error) {
            if (error) {
                App.showMessage({
                    'type' : 'danger',
                    'title': App.i18n('Error'),
                    'body' : App.i18n('JavaScript load error')
                });
            } else {
                callback();
            }
        });
    };

    App.requireAsync = function (namespaces, callback) {
        this.require(namespaces, callback, true);
    };

    App.refreshRequirements = function () {
        var namespaces = [];

        $('[data-require]').each(function () {
            namespaces = namespaces.concat($(this).attr('data-require').split(','))
        });

        namespaces = _.unique(namespaces);

        this.require(namespaces, function () {
            console.log(App.i18n('Requirements loaded'), namespaces);
        });
    };

    App.showMessage = function (attrs) {
        alert('type: ' + attrs.type + ' - ' + attrs.title + ' - ' + attrs.body);
    };

    App.run = function () {
        this.registerDefaultScripts();
        this.initGlobalListeners();
        this.refreshRequirements();
    };

    // global event listeners

    App.initGlobalListeners = function () {

        App.$doc.on('click', '[ui-toggle]', function (e) {
            var $this = $(e.target);
            var $target = $($this.attr('target')) || $this;

            e.preventDefault();

            $target.toggleClass($this.attr('ui-toggle'));
        });

        App.$doc.on('click', '[ui-nav] a', function (e) {
            var $this = $(e.target).closest('a');
            var $nav  = $this.parent();

            $nav.toggleClass('active');

            if ($this.next().is('ul')) {
                e.preventDefault();
            }
        });

        App.$doc.on('click', '[data-confirm]', function (e) {
            if (!confirm($(this).attr('data-confirm'))) {
                e.preventDefault();
            }
        });

        // delete form confirm

        App.$doc.on('submit', 'form', function (e) {

            var $this = $(this);

            var isDeleteMethod = $this.find('input[name=_method][value=DELETE]').length;

            if (isDeleteMethod) {

                if (!confirm($this.attr('data-confirm') || 'Delete?')) {
                    e.preventDefault();
                }
            }
        });

        App.$doc.on('click', '.js-pagination a', function (e) {
            var $this = $(this);
            var $paginationContainter = $('.js-pagination');
            var $target = $($this.closest('.js-pagination').data('target'));
            var url = $this.attr('href');
            e.preventDefault();

            if ($target.data('id')) {
                url += '&exclude_id=' + $target.data('id');
            }

            if ($paginationContainter.data('q')) {
                url = url + '&q=' + encodeURIComponent($paginationContainter.attr('data-q'));
            }

            $target.css({ opacity: '0.5' }).addClass('disabled');

            $target.load(url, function () {
                $target.trigger('changeContent');
                console.debug('trigger changeContent');
                $target.css({ opacity: '1' }).removeClass('disabled');
            });

        });

        App.$doc.on('click', '.js-container-loader', function (e) {
            var $this = $(this);
            var $container = $($this.data('container'));
            var url = $this.data('url');
            e.preventDefault();

            $container.css({ opacity: '0.5' }).addClass('disabled');
            $container.html($('<div/>', {'class': 'text-muted text-center wrapper', 'text': ' ' + App.i18n('loading')})
                .prepend($('<i/>', {'class': 'fa fa-cog fa-spin'})));

            $container.load(url, function () {
                $container.trigger('changeContent');
                console.debug('content was loaded');
                $container.css({ opacity: '1' }).removeClass('disabled');
            });

        });

        // $('.js-garlic').garlic();
    };

    App.registerDefaultScripts = function () {

        this.registerScript('datepicker', [
            'vendor/moment/moment.js',
            'vendor/bootstrap-daterangepicker/daterangepicker.js',
            'vendor/bootstrap-daterangepicker/daterangepicker-bs3.css',
            'js/app/datepicker.js'
        ]);

        this.registerScript('uploader', [
            'vendor/jquery.ui/ui/core.js',
            'vendor/jquery.ui/ui/widget.js',
            'vendor/jquery.ui/ui/mouse.js',
            'vendor/jquery.ui/ui/draggable.js',
            'vendor/jquery.ui/ui/droppable.js',

            'vendor/blueimp-file-upload/js/jquery.iframe-transport.js',
            'vendor/blueimp-file-upload/js/jquery.fileupload.js',

            'js/app/uploader/fileupload.js'
        ]);

        this.registerScript('wysiwyg', [
            'vendor/jquery.ui/ui/core.js',
            'vendor/jquery.ui/ui/widget.js',
            'vendor/jquery.ui/ui/mouse.js',
            'vendor/jquery.ui/ui/draggable.js',
            'vendor/jquery.ui/ui/droppable.js',

            'vendor/ckeditor/ckeditor.js',
            'js/app/wysiwyg/ckeditor.js',

            'js/app/wysiwyg/gallery/plugin.js',
            'css/wysiwyg-galeries.css',
        ]);

        this.registerScript('slug', [
            'js/app/slug/speakingurl.js',
            'js/app/slug/slug.js',
            'js/app/slug/uk.js'
        ]);

        this.registerScript('chosen', [
            'vendor/chosen/chosen.jquery.min.js',
            'js/app/chosen/style.css',
            'js/app/chosen/chosen.js'
        ]);

        this.registerScript('related', [
            'js/app/related.js'
        ]);

        this.registerScript('right-sidebar', [
            'js/app/right-sidebar.js'
        ]);

        this.registerScript('crop', [
            'vendor/cropper/dist/cropper.min.js',
            'vendor/cropper/dist/cropper.min.css',
            'js/app/crop.js'
        ]);

        this.registerScript('article-tags', [
            'vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
            'vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css',
            'js/app/article-tags.js'
        ]);

        this.registerScript('tags', [
            'vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
            'vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css',
            'js/app/tags.js'
        ]);

        this.registerScript('tags-group', [
            'vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.js',
            'vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css',
            'vendor/typeahead.js/dist/typeahead.bundle.min.js',
            'css/tags-group.css',
            'js/app/tags-group.js'
        ]);

        this.registerScript('galleries', [
            'vendor/jquery.ui/ui/core.js',
            'vendor/jquery.ui/ui/widget.js',
            'vendor/jquery.ui/ui/mouse.js',
            'vendor/jquery.ui/ui/draggable.js',
            'vendor/jquery.ui/ui/droppable.js',
            'vendor/jquery.ui/ui/sortable.js',
            'js/app/galleries.js'
        ]);

        this.registerScript('attachments', [
            'vendor/jquery.ui/ui/core.js',
            'vendor/jquery.ui/ui/widget.js',
            'vendor/jquery.ui/ui/mouse.js',
            'vendor/jquery.ui/ui/draggable.js',
            'vendor/jquery.ui/ui/droppable.js',
            'vendor/jquery.ui/ui/sortable.js',
            'js/app/attachments/attachments.js'
        ]);

        this.registerScript('diff', [
            'vendor/jsdifflib/difflib.js',
            'vendor/jsdifflib/diffview.js',
            'vendor/jsdifflib/diffview.css',
            'js/app/diff.js'
        ]);

        this.registerScript('search-form', [
            'js/app/search-form.js'
        ]);

        this.registerScript('tabs', [
            'js/app/tabs.js'
        ]);

        this.registerScript('dragula', [
            'js/app/dragula/dragula.min.js',
            'js/app/dragula/sort.js',
            'css/dragula.css'
        ]);

    };

})(window, jQuery);
