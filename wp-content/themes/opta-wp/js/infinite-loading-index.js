(function ($) {
    "use strict";

    var count = 1;

    if (parseInt(ajax_var.posts_per_page_index) < parseInt(ajax_var.total_index)) {
        $('.more-posts-index').css('visibility', 'visible');
        $('.more-posts-index').animate({opacity: 1}, 1500);
    } else {
        $('.more-posts-index').css('visibility', 'hidden');
        $('.more-posts-index').animate({opacity: 0}, 100, function () {
            $('.load-more-posts').hide();
        });
    }

    $('.more-posts-index:visible').on('click', function () {
        $(".load-more-posts").addClass('move-down');
        count++;
        loadArticleIndex(count);
    });

    function loadArticleIndex(pageNumber) {
        $.ajax({
            url: ajax_var.url,
            type: 'POST',
            data: "action=infinite_scroll_index&page_no_index=" + pageNumber + '&loop_file_index=loop-index&security=' + ajax_var.nonce,
            success: function (html) {
                $(".blog-holder").append(html);

                $(".blog-holder").imagesLoaded(function () {

                    animateElement();

                    if (pageNumber == ajax_var.num_pages_index)
                    {
                        $('.more-posts-index').animate({opacity: 0}, 500,
                                function () {
                                    $('.load-more-posts').hide();
                                });
                    } else
                    {
                        $(".load-more-posts").removeClass('move-down');
                        $(".more-posts-index img").animate({opacity: 1}, 500);
                    }
                });
            }
        });
        return false;
    }

    function animateElement(e) {
        $(".animate").each(function (i) {
            var top_of_object = $(this).offset().top;
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            if ((bottom_of_window) > top_of_object) {
                $(this).addClass('show-it');
            }
        });
    }

})(jQuery);