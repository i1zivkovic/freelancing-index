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
})

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
        url: 'http://localhost:8000/job-comments/' + comment_id,
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


/* ------------------------------------------------------------------------------------------------------------------------------------------ */

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
                    swal.showLoading()
                }
            })
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
        url: 'http://localhost:8000/jobs/' + job_id,
        type: 'DELETE',
        dataType: 'JSON',
        // if job is deleted, display success message and redirect user
        success: function (data) {
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

/* ---------------------------------------------------------------------------------------------------------------------------------- */

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
        url: 'http://localhost:8000/job-likes/' + job_id,
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

/* ---------------------------------------------------------------------------------------------------------------------------------- */



function actOnJobApplicationAction(application_id, application_state_id) {

    // naming
    var application_state_actions = {
        'name' : application_state_id == 2 ? 'accept' : 'reject',
        'verb' :  application_state_id == 2 ? 'Accepting' : 'Rejecting'
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
            })
            jobApplicationHandlerAjax(application_id,application_state_id);
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
        url: 'http://localhost:8000/job-applications/' + application_id,
        type: 'PUT',
        dataType: 'JSON',
        data: {
            application_state_id: application_state_id
        },
        success: function (data) {
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
