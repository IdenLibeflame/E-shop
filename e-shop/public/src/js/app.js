var commentId = 0;
var commentTextElement = null;

$('.edit').on('click', function (event) {
    event.preventDefault();

    commentTextElement = event.target.parentNode.parentNode;
    console.log(commentTextElement);

    var commentText = commentTextElement.childNodes[0].textContent;
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

                $(commentTextElement).find('span').text(msg['new_comment']);
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
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this comment' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this comment' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});



// new Vue({
//
//     el: 'body',
//
//     data: {
//         products: [],
//         loading: false,
//         error: false,
//         query: ''
//     },
//
//     methods: {
//         search: function() {
//             // Clear the error message.
//             this.error = '';
//             // Empty the products array so we can fill it with the new products.
//             this.products = [];
//             // Set the loading property to true, this will display the "Searching..." button.
//             this.loading = true;
//
//             // Making a get request to our API and passing the query to it.
//             this.$http.get('/search/' + this.query).then((response) => {
//                 // If there was an error set the error message, if not fill the products array.
//                 response.body.error ? this.error = response.body.error : this.products = response.body;
//                 // The request is finished, change the loading to false again.
//                 this.loading = false;
//                 // Clear the query.
//                 this.query = '';
//             });
//         }
//     }
//
// });