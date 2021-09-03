<?php
/*
 * Register Theme Customizer
 */
add_action('customize_register', 'cocobasictheme_customize_register');

function cocobasictheme_customize_register($wp_customize) {

    function cocobasic_clean_html($value) {
        $allowed_html_array = opta_allowed_html();
        $value = wp_kses($value, $allowed_html_array);
        return $value;
    }

    class CocoBasic_Customize_Textarea_Control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>
            <?php
        }

    }

    //------------------------- MENU TEXT SECTION ---------------------------------------------

    $wp_customize->add_section('cocobasic_menu_content', array(
        'title' => esc_html__('Menu Text', 'opta-wp'),
        'priority' => 30
    ));


    $wp_customize->add_setting('menu_text', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasic_Customize_Textarea_Control($wp_customize, 'menu_text', array(
        'label' => esc_html__('Text in Menu:', 'opta-wp'),
        'section' => 'cocobasic_menu_content',
        'settings' => 'menu_text',
        'priority' => 999
    )));




    //------------------------- END MENU TEXT SECTION ---------------------------------------------
    //
    //
    //
    //
    //----------------------------- PORTFOLIO SECTION  ---------------------------------------------
    if (post_type_exists('portfolio')) {
        $wp_customize->add_section('cocobasic_portfolio_section', array(
            'title' => esc_html__('Portfolio settings', 'opta-wp'),
            'priority' => 32
        ));

        $wp_customize->add_setting('portfolio_num_items', array(
            'default' => 8,
            'sanitize_callback' => 'absint'
        ));

        $wp_customize->add_control('portfolio_num_items', array(
            'label' => esc_html__('Portfolio num of items to show:', 'opta-wp'),
            'section' => 'cocobasic_portfolio_section',
            'settings' => 'portfolio_num_items',
            'priority' => 999
        ));
    }

    //----------------------------- END PORTFOLIO SECTION  ---------------------------------------------
    //
    //
    //----------------------------- IMAGE SECTION  ---------------------------------------------

    $wp_customize->add_section('cocobasic_image_section', array(
        'title' => esc_html__('Images Section', 'opta-wp'),
        'priority' => 33
    ));


    $wp_customize->add_setting('opta_header_logo', array(
        'default' => get_template_directory_uri() . '/images/logo_@x2.png',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'opta_header_logo', array(
        'label' => esc_html__('Header Logo', 'opta-wp'),
        'section' => 'cocobasic_image_section',
        'settings' => 'opta_header_logo'
    )));

    $wp_customize->add_setting('opta_footer_logo', array(
        'default' => get_template_directory_uri() . '/images/footer_logo_@x2.png',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'opta_footer_logo', array(
        'label' => esc_html__('Footer Logo', 'opta-wp'),
        'section' => 'cocobasic_image_section',
        'settings' => 'opta_footer_logo'
    )));


    //----------------------------- END IMAGE SECTION  ---------------------------------------------
    //
    //
    //
    //----------------------------------COLORS SECTION--------------------

    $wp_customize->add_setting('global_color', array(
        'default' => '#d7b065',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'global_color', array(
        'label' => esc_html__('Global Color', 'opta-wp'),
        'section' => 'colors',
        'settings' => 'global_color'
    )));


    $wp_customize->add_setting('global_select_color', array(
        'default' => '#fae3b5',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'global_select_color', array(
        'label' => esc_html__('Mouse Select Color', 'opta-wp'),
        'section' => 'colors',
        'settings' => 'global_select_color'
    )));


    //----------------------------------------------------------------------------------------------
    //
    //
    //
      //------------------------- FOOTER TEXT SECTION ---------------------------------------------

    $wp_customize->add_section('cocobasic_footer_text_section', array(
        'title' => esc_html__('Footer Text', 'opta-wp'),
        'priority' => 99
    ));


    $wp_customize->add_setting('footer_mail', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasic_Customize_Textarea_Control($wp_customize, 'footer_mail', array(
        'label' => esc_html__('Footer Mail:', 'opta-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'footer_mail',
        'priority' => 999
    )));


    $wp_customize->add_setting('footer_mail_sec', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasic_Customize_Textarea_Control($wp_customize, 'footer_mail_sec', array(
        'label' => esc_html__('Footer Mail Second Line:', 'opta-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'footer_mail_sec',
        'priority' => 999
    )));


    $wp_customize->add_setting('footer_lat', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasic_Customize_Textarea_Control($wp_customize, 'footer_lat', array(
        'label' => esc_html__('Footer Latitude:', 'opta-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'footer_lat',
        'priority' => 999
    )));

    $wp_customize->add_setting('footer_lng', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasic_Customize_Textarea_Control($wp_customize, 'footer_lng', array(
        'label' => esc_html__('Footer Longitude:', 'opta-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'footer_lng',
        'priority' => 999
    )));


    $wp_customize->add_setting('footer_copyright_content', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasic_Customize_Textarea_Control($wp_customize, 'footer_copyright_content', array(
        'label' => esc_html__('Footer Copyright Content:', 'opta-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'footer_copyright_content',
        'priority' => 999
    )));


    $wp_customize->add_setting('footer_social_content', array(
        'default' => '',
        'sanitize_callback' => 'cocobasic_clean_html'
    ));

    $wp_customize->add_control(new CocoBasic_Customize_Textarea_Control($wp_customize, 'footer_social_content', array(
        'label' => esc_html__('Footer Social Content', 'opta-wp'),
        'section' => 'cocobasic_footer_text_section',
        'settings' => 'footer_social_content',
        'priority' => 999
    )));



    //---------------------------- END FOOTER TEXT SECTION --------------------------
    //
    //
    //--------------------------------------------------------------------------
    $wp_customize->get_setting('global_color')->transport = 'postMessage';
    $wp_customize->get_setting('global_select_color')->transport = 'postMessage';
    if (post_type_exists('portfolio')) {
        $wp_customize->get_setting('portfolio_num_items')->transport = 'postMessage';
    }
    $wp_customize->get_setting('menu_text')->transport = 'postMessage';
    $wp_customize->get_setting('footer_mail')->transport = 'postMessage';
    $wp_customize->get_setting('footer_mail_sec')->transport = 'postMessage';
    $wp_customize->get_setting('footer_lat')->transport = 'postMessage';
    $wp_customize->get_setting('footer_lng')->transport = 'postMessage';
    $wp_customize->get_setting('footer_copyright_content')->transport = 'postMessage';
    $wp_customize->get_setting('footer_social_content')->transport = 'postMessage';
    //--------------------------------------------------------------------------
    /*
     * If preview mode is active, hook JavaScript to preview changes
     */
    if ($wp_customize->is_preview() && !is_admin()) {
        add_action('customize_preview_init', 'cocobasictheme_customize_preview_js');
    }
}

/**
 * Bind Theme Customizer JavaScript
 */
function cocobasictheme_customize_preview_js() {
    wp_enqueue_script('cocobasictheme-customizer', get_template_directory_uri() . '/admin/js/custom-admin.js', array('customize-preview'), '20120910', true);
}

/*
 * Generate CSS Styles
 */

class CocoBasicLiveCSS {

    public static function cocobasictheme_customized_style() {
        echo '<style type="text/css">' .
        cocobasic_generate_css('body .site-wrapper a:hover, .site-wrapper .sm-clean li a.current, .site-wrapper .sm-clean .current_page_item a, .site-wrapper .main-menu.sm-clean a:hover, .page .site-wrapper h1.entry-title a, .site-wrapper .single .wp-link-pages, .site-wrapper .comment-reply-link, .site-wrapper .replay-at-author, .site-wrapper .page-numbers.current, .site-wrapper .page-numbers:hover, .site-wrapper .portfolio-text-holder .portfolio-category a', 'color', 'global_color') .
        cocobasic_generate_css('.site-wrapper .page-numbers.current', 'border-color', 'global_color') .
        cocobasic_generate_css('.site-wrapper .slick-dots li:hover button:before, .site-wrapper .slick-dots li.slick-active button:before, .page .site-wrapper h1.entry-title a:after, .site-wrapper .comment-reply-link:after', 'background-color', 'global_color') .
        cocobasic_generate_css('.site-wrapper .grid-item.quote-item:before', 'color', 'global_select_color') .
        cocobasic_generate_css('body .site-wrapper ::selection', 'background-color', 'global_select_color') .
        cocobasic_generate_css('body .site-wrapper ::-moz-selection', 'background-color', 'global_select_color') .
        '</style>';
    }

}

/*
 * Generate CSS Class - Helper Method
 */

function cocobasic_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '') {
    $return = '';
    $mod = get_option($mod_name);
    if (!empty($mod)) {
        $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
        );
    }
    return $return;
}
?>