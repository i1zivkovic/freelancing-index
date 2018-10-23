$(document).ready(function () {



    $('input[type="file"]').change(function (e) {
        if (e.target.files[0]) {
            var fileName = e.target.files[0].name;
            $('#file-label').html(e.target.files[0].name);
        } else {
            $('#file-label').html("Choose file... ");
        }

    });


    $('.js-example-basic-multiple').select2({
        width: '100%',
    });



    $('#skill_list').select2({

        width: '100%',
        placeholder: "",
        minimumInputLength: 2,
        ajax: {
            delay: 300,
            url: 'http://localhost:8000/skills/find',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });


    // CLICK EVENT ON COMMENT
    $("#delete-file").click(function (e) {
        var id = $(this).data('id');
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger mr-3',
            buttonsStyling: false,
        })
        e.preventDefault();
        swalWithBootstrapButtons({
            title: 'Are you sure?',
            text: 'You want to delete this file?',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                deleteFile(id);
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'Your file is safe :)',
                    'error'
                )
            }
        })
    });

    // FUNCTION TO DLETE COMMENT
    function deleteFile(file_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            }
        });
        $.ajax({
            url: 'http://localhost:8000/delete-job-file/' + file_id,
            type: 'DELETE',
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    let timerInterval
                    swal({
                        type: "success",
                        title: 'Please wait!',
                        html: 'Deleting your file..',
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
                            $('#file-info').remove();
                            swal.close();
                        }
                    });
                } else {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'An error has accured while trying to delete the file!',
                    });
                }
            }
        });
    }




});
