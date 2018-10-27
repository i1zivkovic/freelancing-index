
// FOCUS COMMENT INPUT IF IT IS INVALID
if ($('#comment').hasClass('is-invalid')) {
    $('#comment').focus();
}

// swal mixin
const swalWithBootstrapButtons = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger mr-3',
    buttonsStyling: false,
})


// CLICK EVENT ON COMMENT
$(".delete-comment").click(function (e) {
    var id = $(this).data('id');

    e.preventDefault();
    swalWithBootstrapButtons({
        title: 'Are you sure?',
        text: 'You want to delete this comment?',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swal({
                title: 'Deleting your comment...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    swal.showLoading()
                }
            })
            deleteComment(id);
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
                'Cancelled',
                'Your comment is safe :)',
                'error'
            )
        }
    })
});

// FUNCTION TO DLETE COMMENT
function deleteComment(comment_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });
    $.ajax({
        url: 'http://localhost:8000/post-comments/' + comment_id,
        type: 'DELETE',
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            if (data.status == 1) {
                swalWithBootstrapButtons({
                    type: 'success',
                    title: 'Comment deleted.',
                    text: 'You have successfully deleted your comment.',
                    confirmButtonText: 'Reload page',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                });
            } else {
                swalWithBootstrapButtons({
                    type: 'error',
                    title: 'Oops...',
                    text: 'An error has accured while trying to delete the comment!',
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}
/* ---------------------------------------------------------------------------------------------------------------------- */


// CLICK EVENT ON POST DELETE
$(".delete-post").click(function (e) {
    var id = $(this).data('id');
    e.preventDefault();
    swalWithBootstrapButtons({
        title: 'Are you sure?',
        text: 'You want to delete this post?',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swal({
                title: 'Deleting your post...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    swal.showLoading()
                }
            })
            deletePost(id);
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
                'Cancelled',
                'Your post is safe :)',
                'error'
            )
        }
    })
});

// FUNCTION TO DELETE POST
function deletePost(post_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });

    $.ajax({
        url: 'http://localhost:8000/posts/' + post_id,
        type: 'DELETE',
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            if (data.status == 1) {
                swalWithBootstrapButtons({
                    type: 'success',
                    title: 'Post deleted',
                    text: 'You have successfully delete your post.',
                    confirmButtonText: 'Go to posts',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'http://localhost:8000/posts/';
                    }
                });
            } else {
                swalWithBootstrapButtons({
                    type: 'error',
                    title: 'Oops...',
                    text: 'An error has accured while trying to delete the post!',
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

