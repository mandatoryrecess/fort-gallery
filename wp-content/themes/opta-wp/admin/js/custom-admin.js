(function($) {

    // COLORS                         
    wp.customize('global_color', function(value) {
        value.bind(function(to) {            
            var inlineStyle, customColorCssElemnt;
            inlineStyle = '<style class="custom-color-css1">';
            
            inlineStyle += 'body .site-wrapper a:hover, .site-wrapper .sm-clean li a.current, .site-wrapper .sm-clean .current_page_item a, .site-wrapper .main-menu.sm-clean a:hover, .page .site-wrapper h1.entry-title a, .site-wrapper .single .wp-link-pages, .site-wrapper .comment-reply-link, .site-wrapper .replay-at-author, .site-wrapper .page-numbers.current, .site-wrapper .page-numbers:hover, .site-wrapper .portfolio-text-holder .portfolio-category a { color: ' + to + '; }';
            inlineStyle += '.site-wrapper .page-numbers.current { border-color: ' + to + '; }';
            inlineStyle += '.site-wrapper .slick-dots li:hover button:before, .site-wrapper .slick-dots li.slick-active button:before, .page .site-wrapper h1.entry-title a:after, .site-wrapper .comment-reply-link:after { background-color: ' + to + '; }';
            
            inlineStyle += '</style>';
        
            customColorCssElemnt = $('.custom-color-css1');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }                       

        });
    });

    wp.customize('global_select_color', function(value) {
        value.bind(function(to) {            
            var inlineStyle, customColorCssElemnt;
            inlineStyle = '<style class="custom-color-css2">';
            
            inlineStyle += '.site-wrapper .grid-item.quote-item:before { color: ' + to + '; }';
            inlineStyle += 'body .site-wrapper ::selection { background-color: ' + to + '; }';
            inlineStyle += 'body .site-wrapper ::-moz-selection { background-color: ' + to + '; }';
            
            inlineStyle += '</style>';
        
            customColorCssElemnt = $('.custom-color-css2');

            if (customColorCssElemnt.length) {
                customColorCssElemnt.replaceWith(inlineStyle);
            } else {
                $('head').append(inlineStyle);
            }                       

        });
    });
       

    //STATIC TEXT    
    wp.customize('menu_text', function(value) {
        value.bind(function(to) {
            $('.menu-left-text').html(to);
        });
    });

    wp.customize('footer_mail', function(value) {
        value.bind(function(to) {
            $('.footer-first-line').html(to);
        });
    });
    
    wp.customize('footer_mail_sec', function(value) {
        value.bind(function(to) {
            $('.footer-second-line').html(to);
        });
    });
   
    wp.customize('footer_lat', function(value) {
        value.bind(function(to) {
            $('.position-lat').html(to);
        });
    });
    
    wp.customize('footer_lng', function(value) {
        value.bind(function(to) {
            $('.position-lng').html(to);
        });
    });   

    wp.customize('footer_copyright_content', function(value) {
        value.bind(function(to) {
            $('.copyright-footer').html(to);
        });
    });

    wp.customize('footer_social_content', function(value) {
        value.bind(function(to) {
            $('.social-footer').html(to);
        });
    });


})(jQuery);