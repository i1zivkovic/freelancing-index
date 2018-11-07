
$(document).ready(function () {
 // listener for file input
 $('input[type="file"]').change(function (e) {
    if (e.target.files[0]) {
        $('#file-label').html(e.target.files[0].name);
    } else {
        $('#file-label').html('Choose profile image..');
    }

});
});
