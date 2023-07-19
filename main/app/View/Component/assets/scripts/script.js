$(document).ready(function() {
    getMessageList();
});

$('#createMessage').on('click', function() {

    createMessage();
});

$('#updateMessage').on('click', function() {

    let rowid = $('#hiddenUpdateId').val();
    let rowTitle = $('#updateTitle').val();
    let rowContent = $('#updateContent').val();
    updateMessage(rowid, rowTitle, rowContent);
});


$('#getMessageById').on('click', function() {

    getMessageById();
});


$('#deleteMessage').on('click', function() {

    let rowId = $('#hiddenDeleteId').val();
    deleteMessage(rowId);
});

function createMessage() {

    let rowTitle = $('#createTitle').val();
    let rowContent = $('#createContent').val();

    $.ajax({
        type: 'POST',
        cache: false,
        dataType: 'json',
        url: '/message/create',
        data: JSON.stringify({ title: rowTitle, content: rowContent }),
        success: function(data) {

            if (data.status) {
                makerMessage(data.message[0].id, data.message[0].title, data.message[0].content, data.message[0].created)
                rowTitle = $('#createTitle').val('');
                rowContent = $('#createContent').val('');
                $('#createModal').modal('hide');
            } else {
                console.log("data status no true");
            }
            console.log(data);
        }
    });
}

function updateMessage(rowId, rowTitle, rowContent) {

    $.ajax({
        type: 'PATCH',
        cache: false,
        dataType: 'json',
        url: '/message/update/' + rowId,
        data: JSON.stringify({ title: rowTitle, content: rowContent }),
        success: function(data) {

            if (data.status) {

                $(`#updateTitleField${data.message[0].id}`).text(data.message[0].title);
                $(`#updateContentField${data.message[0].id}`).text(data.message[0].content);
                $('#updateModal').modal('hide');
            } else {
                console.log("data status no true");
            }
            console.log(data);
        }
    });
}

function getMessageById(id) {

    $.ajax({
        type: 'GET',
        url: '/message/get/' + id,
        success: function(data) {
            $('#hiddenUpdateId').val(data.message[0].id);
            $('#updateTitle').val(data.message[0].title);
            $('#updateContent').val(data.message[0].content);
        }
    });
}

function getMessageList() {

    $.ajax({
        type: 'GET',
        url: '/message/list',
        success: function(data) {

            if (data.status) {
                for (row of data.message) {
                    makerMessage(row.id, row.title, row.content, row.created);
                }
            } else {
                console.log("data status no true");
            }
            console.log(data);
        }
    });
}

function deleteConfirm(identificator) {

    $('#hiddenDeleteId').val(identificator);
}

function deleteMessage(identificator) {

    $.ajax({
        type: 'DELETE',
        url: '/message/delete/' + identificator,
        success: function(data) {
            console.log(data);
            $(`#${identificator}`).remove();
            $('#deleteModal').modal('hide');
        }
    });
}

function makerMessage(id, title, content, created) {

    $('#list').prepend(`
    <div class="d-flex text-body-secondary pt-3" id="${id}">
        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
            <div class="d-flex justify-content-between">
                <strong class="text-gray-dark" id="updateTitleField${id}">${title}</strong>
            </div>
            <span class="d-block" id="updateContentField${id}">${content}</span>
            <small class="d-block text-end mt-3">${created}</small>
        </div>
        <div class="bd-placeholder-img flex-shrink-0 me-2 rounded">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" onclick="getMessageById(${id})" data-bs-target="#updateModal" data-bs-whatever="Update">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                    </svg>
                    </button>

                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" onclick="deleteConfirm(${id})" data-bs-target="#deleteModal" data-bs-whatever="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                </button>

            </div>
        </div>
    </div>
    `);
}