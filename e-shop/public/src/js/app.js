var commentId = 0;
var commentTextElement = null;

$('.edit').on('click', function (event) {
    event.preventDefault();

    commentTextElement = event.target.parentNode.parentNode.childNodes[0];
    var commentText = commentTextElement.textContent;
    commentId = event.target.parentNode.parentNode.dataset['commentid'];

    $('#comment').val(commentText);

    $('#edit-modal').modal();
});


// $('.modal fade').find('.modal-dialog').find('.modal-content').find('.modal-footer').find('.btn-primary').on('click', function () {

// $( document ).ready(function() {
    $('#modal-save').on('click', function () {
        $.ajax({
            method: 'POST',
            url: url,
            data: {comment: $('#comment').val(), commentId: commentId, _token: token}
        })
            .done(function (msg) {
                $(commentTextElement).text(msg['new_comment']);
                $('#edit-modal').modal('hide');
            });
    });
// });

$('.like').on('click', function (event) {
    event.preventDefault();
    commentId = event.target.parentNode.parentNode.dataset['commentid'];
    var isLike = event.target.previousElementSibling == null;

    $.ajax({
       method: 'POST',
        url: urlLike,
        data: {isLike: isLike, commentId: commentId, _token: token}
    })
        .done(function () {
            
        });
});

