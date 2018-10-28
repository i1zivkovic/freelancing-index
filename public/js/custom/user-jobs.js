/* ------------------------------------------------------------------------------------------------------------------------------------------ */

// swal mixin
const swalWithBootstrapButtons = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger mr-3',
    buttonsStyling: false,
})


// CLICK EVENT ON POST DELETE
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
            )
        }
    })
});

// FUNCTION TO DELETE POST
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
        success: function (data) {
            console.log(data);
            if (data.status == 1) {
                swalWithBootstrapButtons({
                    type: 'success',
                    title: 'Job deleted',
                    text: 'You have successfully delete your job.',
                    confirmButtonText: 'Go to jobs',
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
                    text: 'An error has accured while trying to delete the job!',
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}
