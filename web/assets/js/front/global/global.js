'use strict';

require('bxslider/dist/jquery.bxslider');
require('@fancyapps/fancybox');
require('../../../libs/starrating/js/rating.js');

function initGoToTop() {
    var $goToTop = $('.go-to-top');

    $goToTop.click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
}

function initFixedMenu() {
    $(window).scroll(function() {
        var $nav = $("#SECTION2");
        var $scrollUp = $('.td-scroll-up');
        var scroll = $(window).scrollTop();
    
        if (scroll > 77) {
            $nav.addClass("navbar-fixed-top");
            $scrollUp.removeClass("hidden");
        } else {
            $nav.removeClass("navbar-fixed-top");
            $scrollUp.addClass("hidden");
        }
    });
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

function initScroll() {
    $("#SECTION2 .ladi-element h3").click(function(e) {
        if (!$(this).hasClass('do-click')) {
            e.preventDefault();
            goToByScroll($(this).data('id'));
        }
    });
}

function goToByScroll(id) {
    $('html,body').animate({
        scrollTop: ($("#" + id).offset().top - 80)
    }, 'slow');
}

function intHandleFormContact() {
    var $formComment = $('#form-comment');

    $formComment.on('click', '#form_send', function(e) {
        if ($formComment.valid()) {
            $.ajax({
                type: "POST",
                url: $formComment.attr('action'),
                data: $formComment.serialize(),
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.status === 'success') {
                        alert(response.message);
    
                        // Clear form comment
                        $formComment[0].reset();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    })
}

exports.init = function () {
    initGoToTop();
    initFixedMenu();
    initFancybox();
    initScroll();
    intHandleFormContact();
};