/* ---------------------------------------------------------------------------------------------------------------------------------- */

// Toast swal mixin
const toast = swal.mixin({
    toast: true,
    position: 'bottom-start',
    showConfirmButton: false,
    timer: 3000
});


// Toggle icon actins wrapper in object
var toggleIcon = {
    Follow: function (icon) {
        $(icon).find("i").removeClass('fa-user-plus').addClass('fa-user-minus');
        $(icon).removeClass('btn-common').addClass('btn-danger');
    },

    Unfollow: function (icon) {
        $(icon).find("i").removeClass('fa-user-minus').addClass('fa-user-plus');
        $(icon).removeClass('btn-danger').addClass('btn-common');
    }
};

// Follow/Unfollow handler
var actOnFollowUnfollow = function (event) {

    //get userId
    var userId = $(event).data('id');
    var icon = $(event).find("i").attr('class');

    if (icon.includes('fa-user-plus')) {
        toggleIcon.Follow(event);
        followUnfollowAjax(userId, 'Follow', event);
    } else {
        toggleIcon.Unfollow(event);
        followUnfollowAjax(userId, 'Unfollow', event);
    }

};

// Ajax call to the backend
function followUnfollowAjax(user_id, action, event) {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        }
    });

    $.ajax({
        url: 'http://localhost:8000/follow-unfollow/' + user_id,
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
                text:  error.responseJSON.error ? error.responseJSON.error : 'An error has occured. Please contact our administrator (ivanzivkovic1601@gmail.com).' 
            });

            console.log(action);

            // If error happens, reverse stats and icon
            switch (action) {
                case 'Follow':
                    toggleIcon.Unfollow(event);
                    break;
                case 'Unfollow':
                    toggleIcon.Follow(event);
                    break;
            }
        }
    });
}
