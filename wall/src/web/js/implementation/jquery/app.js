function initMessage(message) {
    let $newDiv = $('#template .message').clone().removeClass('hidden');
    $newDiv.find('div.body').html(message.message);
    $newDiv.find('div.foot span.date').html(message.createdAt);
    return $newDiv;
}

function renderMessageToTop(message) {
    let $newDiv = initMessage(message);
    $("#doc").prepend($newDiv);
}

function renderMessageToBottom(message) {
    let $newDiv = initMessage(message);
    $("#doc").append($newDiv);
}

function render(collection) {
    for (let i in collection) {
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
        error: function (xhr) {
            if (xhr.status === 400) {
                let errors = JSON.parse(xhr.responseText);
                for (let i in errors) {
                    $.growl(
                        i + ' - ' + errors[i],
                        {type: 'danger', position: {from: "top", align: "center"}, z_index: 9999}
                    );
                }
            }
        }
    });
});
