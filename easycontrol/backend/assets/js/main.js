function initSlimScroll() {
    $(".slimscroll").slimScroll({wheelStep: 5, touchScrollStep: 50, opacity: 0}).mouseover(function () {
        $(this).next(".slimScrollBar").css("opacity", .4)
    })
}

function initSelect2() {
    $('select').select2();
}

$(document).ready(function () {
    initSlimScroll();
    initSelect2();
});

if (document.readyState === 'complete') {

} else {
    $(window).on('load', function () {

    });
}

$(window).resize(function () {

});

$(window).scroll(function () {

});