$(function () {

    'use strict';
    $('.logreg-forms h1 .selected').click(function () {
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.logreg-forms form').hide();
        $('.' + $(this).data('class')).fadeIn(100);
    });

    let navH = $('nav').innerHeight();
    var footerh = $('footer').innerHeight();
    $('.container').css('min-height', $(window).height() - (navH + footerh));
    $('.container-fluid').css('min-height', $(window).height() - (navH + footerh));



});