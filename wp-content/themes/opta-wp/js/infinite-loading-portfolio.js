(function ($) {
    "use strict";

    var count = 1;


    if (parseInt(ajax_var_portfolio.posts_per_page) < parseInt(ajax_var_portfolio.total)) {
        $('.more-posts-portfolio').css('visibility', 'visible');
        $('.more-posts-portfolio').animate({opacity: 1}, 1500);
    } else {
        $('.more-posts-portfolio').css('visibility', 'hidden');
        $('.more-posts-portfolio').animate({opacity: 0}, 100, function () {
            $('.load-more-portfolio').hide();
        });
    }


    $('.more-posts-portfolio:visible').on('click', function () {
        $(".load-more-portfolio").addClass('move-down');
        count++;
        loadArticlePortfolio(count);
    });


    function loadArticlePortfolio(pageNumber) {
        $.ajax({
            url: ajax_var_portfolio.url,
            type: 'POST',
            data: "action=infinite_scroll&page_no=" + pageNumber + '&loop_file=loop-portfolio&security=' + ajax_var_portfolio.nonce,
            success: function (html) {


                $("#portfolio").append(html);

                $("#portfolio").imagesLoaded(function () {

                    //Fix for portfolio item text
                    $('.grid-item').not('.loaded').each(function () {

                        $(this).addClass('loaded');

                        //Fix for portfolio item text
                        $('.portfolio-text-holder').each(function () {
                            $(this).find('.portfolio-info').css('margin-top', ($(this).innerHeight() - $(this).find('.portfolio-info').innerHeight()) * 0.5);
                        });

                        animateElement();
                    });

                    if (pageNumber == ajax_var_portfolio.num_pages)
                    {
                        $('.more-posts-portfolio').animate({opacity: 0}, 500,
                                function () {
                                    $('.load-more-portfolio').hide();
                                });
                    } else
                    {
                        $(".load-more-portfolio").removeClass('move-down');
                        $(".more-posts-portfolio img").animate({opacity: 1}, 500);
                    }
                });

            }
        });
        return false;
    }

    $(window).on('load', function () {
        //Image / Testimonial Slider Config
        $(".image-slider, .testimonial-slider").each(function () {
            var id = $(this).attr('id');

            var auto_value = window[id + '_auto'];
            var hover_pause = window[id + '_hover'];
            var dots = window[id + '_dots'];
            var speed_value = window[id + '_speed'];

            auto_value = (auto_value === 'true') ? true : false;
            hover_pause = (hover_pause === 'true') ? true : false;
            dots = (dots === 'true') ? true : false;

            $('#' + id).slick({
                arrows: false,
                dots: dots,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 750,
                autoplay: auto_value,
                autoplaySpeed: speed_value,
                pauseOnHover: hover_pause,
                fade: true,
                draggable: false,
                adaptiveHeight: true
            });
        });


        var g_speed_value = window['gallery_speed'];
        var g_auto_value = window['gallery_auto'];
        g_auto_value = (g_auto_value === 'true') ? true : false;

        $(".carousel-slider").slick({
            arrows: true,
            dots: false,
            infinite: true,
            centerMode: true,
            variableWidth: true,
            speed: g_speed_value,
            autoplaySpeed: g_speed_value,
            autoplay: g_auto_value,
            pauseOnHover: true
        });


        //Fix for portfolio item text
        $('.portfolio-text-holder').each(function () {
            $(this).find('.portfolio-info').css('margin-top', ($(this).height() - $(this).find('.portfolio-info').height()) * 0.33);
        });
    });

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