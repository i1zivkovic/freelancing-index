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

/* ----------------------------------------- COMMENT UPDATE ------------------------------------------------------------------- */


// listener on the edit-comment icon
$(".edit-comment").click(function (e) {
    // prevent default
    e.preventDefault();
    // get comment id
    var id = $(this).data('id');
    // call edit function
    editActions.edit(id);
});


// methods used to handle editing comment wrapped in object
var editActions = {

    /**
     * Method used to handle 'edit' click
     * @param {number} id Comment Id
     */
    edit: function (id) {
        // hide elements
        $('#post_comment_' + id).hide(); // post comment
        $('#post_comment_date_' + id).hide(); // post comment date
        $('#comment_actions_' + id + ' a').hide(); // comment actions (update, delete)
        // append the accepnt and close icons with given id
        $('#comment_actions_' + id).append(
            `<div id="comment_edit_actions_${id}">
                        <a href="#" class="mr-1" id="accept_comment_edit_${id}" data-id="${id}">
                         <i class="lni-check-mark-circle"></i>
                        </a>
                         <a href="#" class="text-danger" id="close_comment_edit_${id}" data-id="${id}">
                         <i class="lni-close"></i>
                        </a>
                        </div>`
        );

        // get current comment text
        var comment = $('#post_comment_' + id).text();

        // append text-area with given id and insert comment value
        $("#comment_input_wrapper_" + id).append(
            '<textarea id="comment-edit-textarea-' + id +
            '" class="form-control" name="comment-edit" cols="45" rows="2" placeholder="" required> ' +
            comment + ' </textarea> ');

        // set the listener for canceling comment edit
        $("#close_comment_edit_" + id).click(function (e) {
            // prevent default
            e.preventDefault();
            // get comment id
            var id = $(this).data('id');
            // call cancel_edit method
            editActions.cancel_edit(id);
        });

        // set the listener for accpeting the comment change
        $("#accept_comment_edit_" + id).click(function (e) {
            // prevent default
            e.preventDefault();
            // get comment id
            var id = $(this).data('id');
            // call the accept edit method
            editActions.accept_edit(id);
        });
    },

    /**
     * Method used to cancel editing
     * @param {number} id Comment Id
     */
    cancel_edit: function (id) {
        // show
        $('#post_comment_' + id).show(); // comment
        $('#post_comment_date_' + id).show(); // date
        $('#comment_actions_' + id + ' a').show(); // actions (update, delete)
        //remove appended actions (accent, cancel)
        $('#comment_edit_actions_' + id).remove();
        //remove the textarea
        $('#comment-edit-textarea-' + id).remove();
    },
    /**
     * Method used to accept editing changes
     * @param {number} id Comment Id
     */
    accept_edit: function (id) {
        // get comment text
        var new_comment = $('#comment-edit-textarea-' + id).val();
        // call ajax method to update comment
        updateComment(id, new_comment);
    }
}


/**
 * Method used to update comment
 * @param {number} comment_id Id of the comment
 * @param {string} comment Comment text
 */
function updateComment(comment_id, comment) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });
    $.ajax({
        url: '/post-comments/' + comment_id,
        type: 'PUT',
        dataType: 'JSON',
        data: {
            comment: comment
        },
        // if comment is updated, display message and reload page
        success: function (data) {
            console.log(data);
            swalWithBootstrapButtons({
                type: 'success',
                title: 'Comment updated.',
                text: '' + data.success,
                confirmButtonText: 'Ok',
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


/* ----------------------------------------- COMMENT DELETE ------------------------------------------------------------------- */

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

/* ----------------------------------------- POST DELETE ------------------------------------------------------------------- */


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

/* ----------------------------------------- LIKE/UNLIKE HANDLER ------------------------------------------------------------------- */

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
