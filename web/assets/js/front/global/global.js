'use strict';

require('bxslider/dist/jquery.bxslider');
require('@fancyapps/fancybox');
require('../../../libs/starrating/js/rating.js');

function initSearchBox() {
    var $formSearch = $('#form-search');
    var $searchField = $('.search-field');

    $searchField.keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();

            if ($searchField.val() === '') {
                $searchField.focus();
            } else {
                $formSearch.submit();
            }
        }
    });
}

function initProtectedContent() {
    $('body').bind('cut copy', function (e) {
        e.preventDefault();
    });
}

function initGoToTop() {
    var $goToTop = $('.go-to-top');

    $goToTop.click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
}

function initProjectHotSlider() {
    $('.bxslider').show().bxSlider({
        auto: true,
        autoControls: false,
        stopAutoOnClick: true,
        pager: false,
        controls: true,
        minSlides: 1,
        maxSlides: 4,
        moveSlides: 1,
        slideMargin: 20,
        touchEnabled: false,
        autoHover: true
    });
}

function initNewsSlider() {
    $('.post-sidebar-bxslider').bxSlider({
        mode: 'vertical',
        auto: true,
        speed: 300,
        autoControls: false,
        stopAutoOnClick: true,
        pager: false,
        controls: false,
        minSlides: 5,
        maxSlides: 5,
        moveSlides: 1,
        slideWidth: 375,
        touchEnabled: false,
        autoHover: true
    });
}

function initFixedMenu() {
    $(window).scroll(function() {
        var $nav = $("#nav");
        var $scrollUp = $('.td-scroll-up');
        var scroll = $(window).scrollTop();
    
        if (scroll > 100) {
            $nav.addClass("navbar-fixed-top");
            $scrollUp.removeClass("hidden");
        } else {
            $nav.removeClass("navbar-fixed-top");
            $scrollUp.addClass("hidden");
        }
    });
}

function initFixedSidebar() {
    $(window).scroll(function() {
        var $sidebar = $("#sidebar .sidebar"),
            $pageDetail = $('.page-detail'),
            scrollTop = $(this).scrollTop(),
            pageDetailHeight =  $pageDetail.outerHeight(),
            sidebarHeight = $sidebar.height(),
            positionFixedMax = pageDetailHeight - sidebarHeight,
            positionFixed = scrollTop < 65 ? 65 : positionFixedMax > scrollTop ? 65 : positionFixedMax - scrollTop + 40 ;
        
        if (scrollTop > 65) {
            $sidebar.css({
                'top': positionFixed,
                'position': 'fixed'
            });
        } else {
            $sidebar.removeAttr("style");
        }
    });
}

function initCostConstruction() {
    var $formType = $('.costs #form_type');
    var $formFloor = $('.costs #form_floor');

    if ($formType.val() == 3) {
        $formFloor.val(1);
        $formFloor.attr('disabled', 'disabled');
    }

    $formType.change(function(e) {
        if ($(this).val() == 3) {
            $formFloor.val(1);
            $formFloor.attr('disabled', 'disabled');
        } else {
            $formFloor.removeAttr('disabled');
        }
    })
}

function initFancybox() {
    var $rating = $('.rating-container .rating');
    var $ratingMessage = $('p.rating-message');
    var $star = $('#form-rating-review .rating-well .star');
    var $formRating = $('#form-rating-review');

    $rating.click(function() {
        $formRating.show();
        $ratingMessage.html('');
        
        $.fancybox.open({
            src: '#form-rating-container',
            touch : false
        });

        return false;
    });

    $('a#rating').click(function(e) {
        e.preventDefault();

        $formRating.show();
        $ratingMessage.html('');
        
        $.fancybox.open({
            src: '#form-rating-container',
            touch : false
        });

        return false;
    });

    $star.on('click', function(e) {
        var rating = $(this).data('value');
        var newsId = $formRating.data('newsId');

        $.ajax({
            type: "POST",
            url: $formRating.attr('action'),
            data: 'rating=' + rating + '&newsId=' + newsId,
            success: function(data) {
                var response = JSON.parse(data);
                
                if (response.status === 'success') {
                    $formRating.hide();
                    $ratingMessage.html(response.message);
                }
            }
        });
    });
}

exports.init = function () {
    initSearchBox();
    initProjectHotSlider();
    initNewsSlider();
    initProtectedContent();
    initGoToTop();
    initFixedMenu();
    initFixedSidebar();
    initCostConstruction();
    initFancybox();
};