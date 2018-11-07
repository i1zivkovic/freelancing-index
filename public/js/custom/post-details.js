// FOCUS COMMENT INPUT IF IT IS INVALID
if ($('#comment').hasClass('is-invalid')) {
    $('#comment').focus();
}

// swal mixin
const swalWithBootstrapButtons = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger mr-3',
    buttonsStyling: false,
});


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
                    swal.showLoading();
                }
            });
            deleteComment(id);
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
                'Cancelled',
                'Your comment is safe :)',
                'error'
            );
        }
    });
});

// FUNCTION TO DLETE COMMENT
function deleteComment(comment_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });
    $.ajax({
        url: '/post-comments/' + comment_id,
        type: 'DELETE',
        dataType: 'JSON',
            // if comment is deleted, display message and reload page
        success: function (data) {
                swalWithBootstrapButtons({
                    type: 'success',
                    title: 'Comment deleted.',
                    text: '' + data.success,
                    confirmButtonText: 'Reload page',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                });
        },
         // if error happens, display error message
         error: function (error) {
            swalWithBootstrapButtons({
                type: 'error',
                title: 'Oops...',
                text: '' + error.responseJSON.error,
            });
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
                    swal.showLoading();
                }
            });
            deletePost(id);
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
                'Cancelled',
                'Your post is safe :)',
                'error'
            );
        }
    });
});

// FUNCTION TO DELETE POST
function deletePost(post_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });

    $.ajax({
        url: '/posts/' + post_id,
        type: 'DELETE',
        dataType: 'JSON',
        success: function (data) {
                swalWithBootstrapButtons({
                    type: 'success',
                    title: 'Post deleted',
                    text: '' + data.success,
                    confirmButtonText: 'Go to posts',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'http://localhost:8000/posts/';
                    }
                });
        },
           // if error happens, display error message
           error: function (error) {
            swalWithBootstrapButtons({
                type: 'error',
                title: 'Oops...',
                text: '' + error.responseJSON.error,
            });
        }
    });
}

/* ---------------------------------------------------------------------------------------------------------------------------------- */

// Toast swal mixin
const toast = swal.mixin({
    toast: true,
    position: 'bottom-start',
    showConfirmButton: false,
    timer: 3000
});



// Stats handler functions wrapped in object
var updatePostLikesStats = {
    Like: function () {
        document.querySelector('#post-likes-count').textContent++;
    },

    Unlike: function () {
        document.querySelector('#post-likes-count').textContent--;
    }
};

// Toggle icon actins wrapper in object
var toggleIcon = {
    Like: function () {
        $('#post-like-action').removeClass('lni-heart').addClass('lni-heart-filled');
    },

    Unlike: function () {
        $('#post-like-action').removeClass('lni-heart-filled').addClass('lni-heart');
    }
};

// Like/Unlike handler
var actOnLikeUnlike = function (event) {

    var postId = $('#post-like-button').data('id');
    var icon = event.target.className;

    if (icon == 'lni-heart') {
        updatePostLikesStats.Like();
        toggleIcon.Like();
        likeUnlikeAjax(postId, 'Like');
    } else {
        updatePostLikesStats.Unlike();
        toggleIcon.Unlike();
        likeUnlikeAjax(postId, 'Unlike');
    }

};

// Ajax call to the backend
function likeUnlikeAjax(post_id, action) {

    console.log('Ajax data');
    console.log(post_id);
    console.log(action);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });

    $.ajax({
        url: '/post-likes/' + post_id,
        type: 'POST',
        dataType: 'JSON',
        data: {
            action: action
        },
        success: function (data) {
            // Display success message
            toast({
                type: 'success',
                title: '' + data.success
            });
        },
        error: function (error) {
            // Display error message
            toast({
                type: 'error',
                title: 'Oops...',
                text: '' + error.responseJSON.error
            });

            // If error happens, reverse stats and icon
            switch (action) {
                case 'Like':
                    updatePostLikesStats.Unlike();
                    toggleIcon.Unlike();
                    break;
                case 'Unlike':
                    updatePostLikesStats.Like();
                    toggleIcon.Like();
                    break;
            }
        }
    });
}
