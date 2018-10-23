$(document).ready(function () {

    $('input[type="file"]').change(function (e) {
        if (e.target.files[0]) {
            var fileName = e.target.files[0].name;
            $('#file-label').html(e.target.files[0].name);
        } else {
            $('#file-label').html('Choose file..');
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
});
