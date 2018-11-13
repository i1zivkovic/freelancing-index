/**
 * Focus comment input if it has error (used when contacting user)
 */
if ($('#contact_name').hasClass('is-invalid') || $('#contact_email').hasClass('is-invalid') || $('#contact_subject').hasClass('is-invalid') || $('#contact_message').hasClass('is-invalid')) {
    $('#contact_name').focus();
}



$(document).ready(function () {
    var testiOwl = $("#testimonials");
    testiOwl.owlCarousel({
        autoplay:true,
        margin:30,
        dots:true,
        autoplayHoverPause:true,
        nav:false,
        loop:true,
        responsiveClass:true,
        responsive:{
            0: {
                items:1,
            },
            991:{
                items:1
          }
        }
    });
});
