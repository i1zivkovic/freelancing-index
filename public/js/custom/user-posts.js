
// CLICK EVENT ON POST DELETE
$(".delete-post").click(function (e) {
    var id = $(this).data('id');
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger mr-3',
        buttonsStyling: false,
    })
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
                let timerInterval
                swal({
                    type: "success",
                    title: 'Please wait!',
                    html: 'Deleting your post..',
                    timer: 500,
                    onOpen: () => {
                        swal.showLoading()
                        timerInterval = setInterval(() => {}, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    if (
                        result.dismiss === swal.DismissReason.timer
                    ) {
                        $('#row_' + post_id).remove();
                        swal.close();
                    }
                });
            } else {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'An error has accured while trying to delete the post!',
                });
            }
        }
    });
}
