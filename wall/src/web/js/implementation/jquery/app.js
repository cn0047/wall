function initMessage(message) {
    $newDiv = $('#template .message').clone().removeClass('hidden');
    $newDiv.find('div.body').html(message.message);
    $newDiv.find('div.foot span.date').html(message.createdAt);
    return $newDiv;
}

function renderMessageToTop(message) {
    $newDiv = initMessage(message);
    $("#doc").prepend($newDiv);
}

function renderMessageToBottom(message) {
    $newDiv = initMessage(message);
    $("#doc").append($newDiv);
}

function render(collection) {
    for (i in collection) {
        renderMessageToBottom(collection[i]);
    }
}

$(document).ready(function () {
    $.getJSON('messages/get/', {limit: 20, offset: 0}, function (res) {
        render(res);
    });
});

$('#btnSaveNewMsg').click(function () {
    $.ajax({
        url: 'messages/create/',
        dataType: 'json',
        type: 'post',
        data: {userId: 0, message: $('#newDlg textarea').val()},
        success: function (res) {
            $('#newDlg').modal('toggle');
            renderMessageToTop(res);
            $('#newDlg textarea').val('');
        },
        error: function (xhr, status, error) {
            if (xhr.status === 400) {
                var errors = JSON.parse(xhr.responseText);
                for (i in errors) {
                    $.growl(
                        i + ' - ' + errors[i],
                        {type: 'danger', position: {from: "top", align: "center"}, z_index: 9999}
                    );
                }
            }
        }
    });
});
