$(function () { objectFitImages() });
$(document).ready(function () {
    //$('.jumbotron').prev('#banner').removeClass('shrink');
    if ($('#hero').length) {
        $('#banner').removeClass('shrink');
    }
    var quantity = 1;
});
$(document).on("scroll", function () {
    if ($('#hero').length) {
        if ($(document).scrollTop() > 86) {
            $('#banner').addClass('shrink');
        }
        else {
            $('#banner').removeClass('shrink');
        }
    }
});
