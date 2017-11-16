var commentId = 0;
var commentTextElement = null;

$('.edit').on('click', function (event) {
    event.preventDefault();

    commentTextElement = event.target.parentNode.parentNode;

    var commentText = commentTextElement.childNodes[0].textContent;
    commentId = event.target.parentNode.parentNode.dataset['commentid'];
    console.log(commentText);

    $('#comment').val(commentText);

    $('#edit-modal').modal();
});



    $('#modal-save').on('click', function () {
        $.ajax({
            method: 'POST',
            url: url,
            data: {comment: $('#comment').val(), commentId: commentId, _token: token}
        })
            .done(function (msg) {

                $(commentTextElement).find('#span_comment').text(msg['new_comment']);
                $('#edit-modal').modal('hide');
            });
    });

$('.like').on('click', function (event) {
    event.preventDefault();
    commentId = event.target.parentNode.parentNode.dataset['commentid'];
    var isLike = event.target.previousElementSibling == null;

    $.ajax({
       method: 'POST',
        url: urlLike,
        data: {isLike: isLike, commentId: commentId, _token: token}
    })
        .done(function (response) {
            $('#rating-' + commentId).html(response.rating);

            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this comment' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this comment' : 'Dislike';

            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});


