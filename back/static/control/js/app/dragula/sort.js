var $parent = $('#sort'),
    $itemsContainer = $('.js-container'),
    action = $parent.data('action');
    token = $parent.data('token');

dragula([sort], {
    moves: function (el, source, handle) {
        var $handle = $(handle);

        return $handle.hasClass('rb-move')
            || !!$handle.closest('.rb-move').length;
    }
}).on('drop', function () {
    sortData = calcPriority();
    sendSortData(sortData);
});

function sendSortData(sortData) {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': token },
        type: 'POST',
        url: action,
        data: sortData,
        beforeSend: function () {
            disableDrag();
        },
        success: function(data) {
            enableDrag();
        },
        error: function (data) {
            enableDrag();
        },
        complete: function () {
            enableDrag();
        }
    });
}

function calcPriority() {
    var ids = [],
        priorities = [];

    $itemsContainer.find(':input[type=hidden]').each(function(index, el) {
        $(el).val(index);
        priorities.push(index);
        ids.push($(el).data('element-id'));
    });

    return {
        ids: ids,
        priorities: priorities,
    };
}

function disableDrag() {
    $itemsContainer.find(':button').each(function(index, el) {
        $(el).removeClass('rb-move').attr('disabled','disabled');
    });
}

function enableDrag() {
    $itemsContainer.find(':button').each(function(index, el) {
        $(el).addClass('rb-move').removeAttr('disabled');
    });
}
