(function ($) {
    "use strict";

    $(window).on('scroll', function () {
        animateElement();
    });

    $('.single-post .num-comments a, .single-portfolio .num-comments a').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: $(this.hash).offset().top}, 2000);
        return false;
    });
    
    fixPullquoteClass();

    //Add before and after "blockquote" custom class
    $('blockquote.inline-blockquote').prev('p').addClass('wrap-blockquote');
    $('blockquote.inline-blockquote').next('p').addClass('wrap-blockquote');
    $('blockquote.inline-blockquote').css('display', 'table');

    //Placeholder show/hide
    $('input, textarea').focus(function () {
        $(this).data('placeholder', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    });
    $('input, textarea').blur(function () {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });

    //Fix for footer
    if ($('#comments').length)
    {
        $(".footer").css('margin-top', '0');
    }

    //Fix for menu alignment
    if (!$('.menu-left-text').length)
    {
        $('.menu-holder').addClass('no-left-part');
    }

    $(".site-content").fitVids();

    $(".default-menu ul:first").addClass('sm sm-clean main-menu');



    $(window).on('load', function () {

        //Set menu
        $('.main-menu').smartmenus({
            subMenusSubOffsetX: 1,
            subMenusSubOffsetY: -8,
            markCurrentItem: true
        });


        var $mainMenu = $('.main-menu').on('click', 'span.sub-arrow', function (e) {
            var obj = $mainMenu.data('smartmenus');
            if (obj.isCollapsible()) {
                var $item = $(this).parent(),
                        $sub = $item.parent().dataSM('sub');
                $sub.dataSM('arrowClicked', true);
            }
        }).bind({
            'beforeshow.smapi': function (e, menu) {
                var obj = $mainMenu.data('smartmenus');
                if (obj.isCollapsible()) {
                    var $menu = $(menu);
                    if (!$menu.dataSM('arrowClicked')) {
                        return false;
                    }
                    $menu.removeDataSM('arrowClicked');
                }
            }
        });



//Show-Hide header sidebar
        $('#toggle, .menu-wraper').on('click', multiClickFunctionStop);
        $('.main-menu, .search-field').on('click', function (e) {
            e.stopPropagation();
        });

        commentFormWidthFix();
        contactFormWidthFix();

        $('.grid-item').addClass('loaded');

        //Fix for portfolio/gallery item text
        $('.portfolio-text-holder').each(function () {
            $(this).find('.portfolio-info').css('margin-top', ($(this).innerHeight() - $(this).find('.portfolio-info').innerHeight()) * 0.5);
        });
        $('.carousel-slider .slick-slide .item-text').each(function () {
            $(this).find('a').css('margin-top', ($(this).innerHeight() - $(this).find('a').innerHeight()) * 0.5);
        });


        // Animate the elemnt if is allready visible on load
        animateElement();

        $('.doc-loader').fadeOut('slow');

    });


    $(window).on('resize', function () {

        commentFormWidthFix();
        contactFormWidthFix();

        //Fix for portfolio/gallery item text
        $('.portfolio-text-holder').each(function () {
            $(this).find('.portfolio-info').css('margin-top', ($(this).innerHeight() - $(this).find('.portfolio-info').innerHeight()) * 0.5);
        });
        $('.carousel-slider .slick-slide .item-text').each(function () {
            $(this).find('a').css('margin-top', ($(this).innerHeight() - $(this).find('a').innerHeight()) * 0.5);
        });
    });

//------------------------------------------------------------------------
//Helper Methods -->
//------------------------------------------------------------------------


    function animateElement(e) {
        $(".animate").each(function (i) {
            var top_of_object = $(this).offset().top;
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            if ((bottom_of_window) > top_of_object) {
                $(this).addClass('show-it');
            }
        });
    }

    function commentFormWidthFix() {
        $('#commentform').find('.custom-text-class').each(function () {
            var textWidth = $(this).innerWidth() + 1;
            $(this).next('.custom-field-class').width($('#commentform').innerWidth() - textWidth - 5);
            $(this).next('.custom-field-class').find('input').outerWidth($('#commentform').innerWidth() - textWidth - 5);
            $(this).next('.custom-field-class').find('textarea').outerWidth($('#commentform').innerWidth() - textWidth - 5);
        });
    }


    function contactFormWidthFix() {
        $('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea').innerWidth($('.wpcf7-form').width());
    }

    function multiClickFunctionStop(e) {
        if ($(e.target).is('.menu-wraper') || $(e.target).is('.menu-right-part') || $(e.target).is('.menu-holder') || $(e.target).is('#toggle') || $(e.target).is('#toggle div'))
        {

            $('#toggle, .menu-wraper').off("click");
            $('#toggle').toggleClass("on");
            if ($('#toggle').hasClass("on"))
            {
                $('.header-holder').addClass('down');
                $('.menu-wraper, .menu-holder').addClass('show');
                $('#toggle, .menu-wraper').on("click", multiClickFunctionStop);
            } else
            {
                $('.header-holder').removeClass('down');
                $('.menu-wraper, .menu-holder').removeClass('show');
                $('#toggle, .menu-wraper').on("click", multiClickFunctionStop);
            }
        }
    }

    function fixPullquoteClass() {
        $("figure.wp-block-pullquote").find('blockquote').first().addClass('cocobasic-block-pullquote');
    }

    function is_touch_device() {
        return !!('ontouchstart' in window);
    }

})(jQuery);