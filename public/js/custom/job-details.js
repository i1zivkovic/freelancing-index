/**
 * Focus comment input if it has error (used when posting a comment)
 */
if ($('#comment').hasClass('is-invalid')) {
    $('#comment').focus();
}

/**
 * Bootstrap swal mixin
 */
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
        $('#job_comment_' + id).hide(); // job comment
        $('#job_comment_date_' + id).hide(); // job comment date
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
        var comment = $('#job_comment_' + id).text();

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
        $('#job_comment_' + id).show(); // comment
        $('#job_comment_date_' + id).show(); // date
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
        url: '/job-comments/' + comment_id,
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


/**
 * Click handler for 'delete-comment' icon
 */
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

/**
 * Function used to delete comment
 * @param {*} comment_id Id of the comment
 */
function deleteComment(comment_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });
    $.ajax({
        url: '/job-comments/' + comment_id,
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


/* ----------------------------------------- JOB DELETE ------------------------------------------------------------------- */

/**
 * Click handler for the 'delete-job' icon
 */
$(".delete-job").click(function (e) {
    var id = $(this).data('id');
    e.preventDefault();
    swalWithBootstrapButtons({
        title: 'Are you sure?',
        text: 'You want to delete this job?',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            swal({
                title: 'Deleting your job...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            deleteJob(id);
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
                'Cancelled',
                'Your job is safe :)',
                'error'
            );
        }
    });
});

/**
 * Function used to delete the job
 * @param {} job_id Id of the job
 */
function deleteJob(job_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });

    $.ajax({
        url: '/jobs/' + job_id,
        type: 'DELETE',
        dataType: 'JSON',
        // if job is deleted, display success message and redirect user
        success: function (data) {
            console.log(data);
            swalWithBootstrapButtons({
                type: 'success',
                title: 'Job deleted',
                text: '' + data.success,
                confirmButtonText: 'Go to jobs',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'http://localhost:8000/jobs/';
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

/* ----------------------------------------- JOB LIKE HANDLER ------------------------------------------------------------------- */

/**
 * SWAL2 toast mixin
 */
const toast = swal.mixin({
    toast: true,
    position: 'bottom-start',
    showConfirmButton: false,
    timer: 3000
});



/**
 * Function wrapper in object used to manage stats
 */
var updateJobLikesStats = {
    Like: function () {
        document.querySelector('#job-likes-count').textContent++;
    },

    Unlike: function () {
        document.querySelector('#job-likes-count').textContent--;
    }
};


/**
 * Function wrapped in object used to toggle icon class
 */
var toggleIcon = {
    Like: function () {
        $('#job-like-action').removeClass('lni-heart').addClass('lni-heart-filled');
    },

    Unlike: function () {
        $('#job-like-action').removeClass('lni-heart-filled').addClass('lni-heart');
    }
};

/**
 * Function used to handle like or unlike based on the icon
 * @param {*} event Click event -> used for getting icon class
 */
var actOnLikeUnlike = function (event) {

    // get data
    var jobId = $('#job-like-button').data('id');
    var icon = event.target.className;

    // check which action is executed based on the icon
    if (icon == 'lni-heart') {
        updateJobLikesStats.Like();
        toggleIcon.Like();
        likeUnlikeAjax(jobId, 'Like');
    } else {
        updateJobLikesStats.Unlike();
        toggleIcon.Unlike();
        likeUnlikeAjax(jobId, 'Unlike');
    }

};

/**
 * Function used to handle like/unlike
 * @param {*} job_id Id of the job
 * @param {*} action Action (like / unlike)
 */
function likeUnlikeAjax(job_id, action) {
    // Set x-csrf token to headers
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });

    $.ajax({
        url: '/job-likes/' + job_id,
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
                    updateJobLikesStats.Unlike();
                    toggleIcon.Unlike();
                    break;
                case 'Unlike':
                    updateJobLikesStats.Like();
                    toggleIcon.Like();
                    break;
            }
        }
    });
}

/* ----------------------------------------- JOB APPLICATIONS HANDLER ------------------------------------------------------------------- */



function actOnJobApplicationAction(application_id, application_state_id) {

    // naming
    var application_state_actions = {
        'name': application_state_id == 2 ? 'accept' : 'reject',
        'verb': application_state_id == 2 ? 'Accepting' : 'Rejecting'
    };

    // show prompt in a form of swal2
    swalWithBootstrapButtons({
        title: 'Are you sure?',
        text: 'You want to ' + application_state_actions.name + ' this job application?',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No!',
        reverseButtons: true
    }).then((result) => {
        // if pressed confirm button
        if (result.value) {
            swal({
                title: '' + application_state_actions.verb + ' this job application...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            jobApplicationHandlerAjax(application_id, application_state_id);
        }
        // if pressed cancel button
        else if (
            result.dismiss === swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons(
                'Cancelled',
                'This job application is left untouched.',
                'error'
            );
        }
    });
}



/**
 * Function used to update job application status
 * @param {*} application_id Id of the job application
 * @param {*} application_state_id State (3-Rejected / 2-Accepted)
 */
function jobApplicationHandlerAjax(application_id, application_state_id) {

    // Set x-csrf token to headers
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });

    $.ajax({
        url: '/job-applications/' + application_id,
        type: 'PUT',
        dataType: 'JSON',
        data: {
            application_state_id: application_state_id
        },
        success: function (data) {

            console.log(data);
            // Display success message
            swalWithBootstrapButtons({
                type: 'success',
                title: 'Result:',
                text: 'Job application successfully ' + data.verb + '.',
                confirmButtonText: 'Reload',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            });
        },
        error: function (error) {
            // Display error message
            swalWithBootstrapButtons({
                type: 'error',
                title: 'Oops...',
                text: '' + error.responseJSON.error,
            });
        }
    });
}
