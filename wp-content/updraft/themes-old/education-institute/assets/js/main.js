(function($) {
    "use strict";

    var $mainwindow = $(window);
    $mainwindow.on('load', function() {

        $(".preloader").fadeOut(1000);
    });

    /*--
  Menu Sticky
-----------------------------------*/
    var windows = $(window);
    var sticky = $('.main-menu , .main-menu-light')
    windows.on('scroll', function() {
        var scroll = windows.scrollTop();
        if (scroll < 50) {
            sticky.removeClass('stick');
        } else {
            sticky.addClass('stick');
        }
    });
    /*--------------- navigation menu---------------*/
    var logo_path = $('.mobile-menu').data('logo');
    $('#main-menu').slicknav({
        appendTo: '.mobile-menu',
        removeClasses: true,
        label: '',
        closedSymbol: '<i class="fa fa-angle-right"><i/>',
        openedSymbol: '<i class="fa fa-angle-down"><i/>'
    });

    /*-- 
        ScrollUp
    -----------------------------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-long-arrow-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

})(jQuery);