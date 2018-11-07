$(document).ready(function () {

    // listener for file input
    $('input[type="file"]').change(function (e) {
        if (e.target.files[0]) {
            var fileName = e.target.files[0].name;
            $('#file-label').html(e.target.files[0].name);
        } else {
            $('#file-label').html('Choose file..');
        }

    });



    // create select 2
    $('.js-example-basic-multiple').select2({
        width: '100%',
    });

    // create select 2 with ajax
    $('#skill_list').select2({

        width: '100%',
        placeholder: "",
        minimumInputLength: 2,
        ajax: {
            delay: 300,
            url: '/skills/find',
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
});
