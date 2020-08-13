'use strict';

var $ = require('jquery');

require('bootstrap-sass');

var news = require('./pages/news');
var global = require('./global/global');

var app = {
    init: function () {
        news.init();
        global.init();
    }
};

// initialize app
$(document).ready(function () {
    app.init();

    var video_wrapper = $('.youtube-video-place');
    
    if (video_wrapper.length) {
        // If user clicks on the video wrapper load the video.
        $('.play-youtube-video').on('click', function() {
            /* Dynamically inject the iframe on demand of the user.
            Pull the youtube url from the data attribute on the wrapper element. */
            $(this).parent('.youtube-video-place').html('<iframe width="282" height="220" allowfullscreen frameborder="0" class="embed-responsive-item" src="' + $(this).parent('.youtube-video-place').data('yt-url') + '"></iframe>');
        });
    }
});