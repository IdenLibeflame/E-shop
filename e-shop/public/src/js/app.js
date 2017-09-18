var commentId = 0;

$('.post').on('click', function (event) {
    event.preventDefault();

    var commentText = event.target.parentNode.parentNode.childNodes[0].textContent;
    commentId = event.target.parentNode.parentNode.dataset['commentid'];

    $('#post-body').val(commentText);
    $('#edit-modal').modal();
});


// $('.modal fade').find('.modal-dialog').find('.modal-content').find('.modal-footer').find('.btn-primary').on('click', function () {

$('#modal-save').on('click', function () {
   $.ajax({
       method: "POST",
       url: url,
       data: {body: $('#post-body').val(), commentId: commentId, _token: token}
   })
       .done(function (msg) {
       console.log(msg['message']);
    });
});