'use strict';

var ed,
    formData = '';

$('body').append(getModal());

CKEDITOR.plugins.add( 'gallery', {
    init: function( editor ) {
        var $view;

        ed = editor;

        editor.ui.addButton('gallery',
        {
            label: 'Галерея',
            command: 'modal',
            icon: this.path + '../../../../js/app/wysiwyg/gallery/icons/gallery.png'
        });

        editor.addCommand("modal", {
            exec: function(edt) {
                $view = getSliders(1);
                $('#selectModal').modal("show");
            }
        });
    }
});

$('.js-modal-search-form').submit(function( event ) {
    event.preventDefault();
    formData = $("input[name=search]").val();
    getSliders(null, formData);
});

$('.js-save').on('click', function( event ) {
    var checkedGalleryId;
    checkedGalleryId = $("input[name=gallery]:checked").val();
    insertTag(ed, checkedGalleryId);
});

$('.js-modal').on('click', '.pagination a', function (e) {
    e.preventDefault();
    getSliders($(this).attr('href').split('page=')[1], formData);
});

function insertTag(editor, galleryId) {
    if (!galleryId) {
        alert('Виберіть галерею для вставки');
        return false;
    } else {
        var galleryTag = editor.document.createElement('p');
        galleryTag.setText('[galleryId=' + galleryId + ']');
        editor.insertElement(galleryTag);
        $('#selectModal').modal("hide");
    }
}

function getSliders(page, search) {
    var $modalBody = $('.js-modal-body'),
        url = window.App.ckeditorGalleryUrl;

    if (!search) {
        search = '';
    }

    $.ajax({
        type:'GET',
        url:  url + '?page=' + page + '&q=' + search,
        success:function(data){
            $modalBody.empty();
            $modalBody.append(data.view);
        },
        async: false
    });
};

function getModal() {
    return $('.js-modal');
}
