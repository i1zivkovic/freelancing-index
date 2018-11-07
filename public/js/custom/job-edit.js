$(document).ready(function () {


    // listener for input file
    $('input[type="file"]').change(function (e) {
        if (e.target.files[0]) {
            var fileName = e.target.files[0].name;
            $('#file-label').html(e.target.files[0].name);
        } else {
            $('#file-label').html("Choose file... ");
        }

    });


    // create select 2
    $('.js-example-basic-multiple').select2({
        width: '100%',
    });


    // create select 2 for skills with ajax
    $('#skill_list').select2({

        width: '100%',
        placeholder: "",
        minimumInputLength: 2,
        ajax: {
            delay: 300,
            url: 'skills/find',
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


    // swal mixin
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger mr-3',
        buttonsStyling: false,
    });

    // CLICK EVENT ON COMMENT
    $("#delete-file").click(function (e) {
        var id = $(this).data('id');
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
                swal({
                    title: 'Deleting your file...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
                deleteFile(id);
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'Your file is safe :)',
                    'error'
                );
            }
        });
    });

    // FUNCTION TO DLETE COMMENT
    function deleteFile(file_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            }
        });
        $.ajax({
            url: 'delete-job-file/' + file_id,
            type: 'DELETE',
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    swalWithBootstrapButtons({
                        type: 'success',
                        title: 'File deleted',
                        text: 'You have successfully delete your file.',
                        confirmButtonText: 'Ok',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });
                } else {
                    swalWithBootstrapButtons({
                        type: 'error',
                        title: 'Oops...',
                        text: 'An error has accured while trying to delete the file!',
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }




});
