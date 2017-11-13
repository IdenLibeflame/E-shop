var commentId = 0;
var commentTextElement = null;

$('.edit').on('click', function (event) {
    event.preventDefault();

    commentTextElement = event.target.parentNode.parentNode;
    // console.log(commentTextElement);

    var commentText = commentTextElement.childNodes[0].textContent;
    commentId = event.target.parentNode.parentNode.dataset['commentid'];
    console.log(commentText);

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

                $(commentTextElement).find('#span_comment').text(msg['new_comment']);
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
        .done(function (response) {
            // event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this comment' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this comment' : 'Dislike';

            // response = JSON.parse(response);

            $('#rating-' + commentId).html(response.rating);

            if (isLike) {
                event.target.innerText == 'Like';
                if (event.target.innerText == 'Like') {
                    event.target.innerText = 'You like this comment';
                } else {
                    event.target.innerText = 'Like';
                }
            } else {
                event.target.innerText == 'Dislike';
                if (event.target.innerText == 'Dislike') {
                    event.target.innerText = 'You don\'t like this comment';
                } else {
                    event.target.innerText = 'Dislike';

                }
            }
            // $('.rating').html(function (i, rating) {
            //     return rating * 1 + 1;
            // });

            // $('.rating').html(function (i, rating) {
            //     return rating * 1 - 1;
            // });

            // $('.rating').html(rating);

            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});


// $(document).ready(function(event) {
//     // event.preventDefault();
//     commentId = event.target.parentNode.parentNode.dataset['commentid'];
//
//     $.ajax({
//         method: 'POST',
//         url: urlLike,
//         data: {commentId: commentId, _token: token, rating: rating},
//         success: function(rating){ // в случае удачного завершения запроса к серверу
//             // в переменной data - ответ сервера
//             if(rating){
//                 $('.rating').html(rating); // выводим статью в нужный блок
//             }
//         }
//     })
// });

