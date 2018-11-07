
$(document).ready(function () {
$('#skill_list').select2({

    width: '100%',
    placeholder: "Choose skills...",
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
