<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>        
        <meta charset="<?php bloginfo('charset'); ?>" />        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />  		
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
		<?php wp_body_open(); ?>

        <div class="site-wrapper">
            
            <div class="doc-loader"></div>       

            <div class="menu-wraper center-relative">                          
                <div class="menu-holder">
                    <div class="menu-left-part">     
                        <?php
                        $allowed_html_array = opta_allowed_html();
                        if (get_theme_mod('menu_text') != ''):
                            echo '<div class="menu-left-text">';
                            echo wp_kses(__(get_theme_mod('menu_text') ? get_theme_mod('menu_text') : 'Welcome to our online art journey. You can read our <a href="#">thoughts</a> or you can simply <a href="#">write to us</a>', 'opta-wp'), $allowed_html_array);
                            echo '</div>';
                        endif;
                        ?>
                    </div>
                    <div class="menu-right-part">
                        <?php
                        if (has_nav_menu("custom_menu")) {
                            wp_nav_menu(
                                    array(
                                        "container" => "nav",
                                        "container_class" => "big-menu",
                                        "container_id" => "header-main-menu",
                                        "fallback_cb" => false,
                                        "menu_class" => "main-menu sm sm-clean",
                                        "theme_location" => "custom_menu",
                                        "items_wrap" => '<ul id="%1$s" class="%2$s">%3$s</ul>' . get_search_form(false),
                                        "walker" => new opta_header_menu()
                                    )
                            );
                        } else {
                            echo '<nav id="header-main-menu" class="big-menu default-menu"><ul>';
                            wp_list_pages(array("depth" => "3", 'title_li' => ''));
                            echo '</ul>' . get_search_form(false) . '</nav>';
                        }
                        ?>
                        <?php if (function_exists('opta_get_cat')): ?>
                            <div class="menu-portfolio-category">
                                <?php echo wp_kses(opta_get_cat('all'), $allowed_html_array); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="header-holder center-relative relative content-1140">
                <div class="header-logo center-text">
                    <?php
                    if (get_option('opta_header_logo') !== ''):
                        if ((is_page()) && (wp_kses(get_post_meta($post->ID, "page_show_title", true), $allowed_html_array) == 'no')):
                            ?>
                            <h1 class="site-logo">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo esc_url(get_option('opta_header_logo', get_template_directory_uri() . '/images/logo_@x2.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                                </a>        
                            </h1>                                                                        
                        <?php else: ?>                    
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url(get_option('opta_header_logo', get_template_directory_uri() . '/images/logo_@x2.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                            </a>               
                        <?php endif; ?>                   
                    <?php endif; ?>                   
                </div>

                <div class="toggle-holder absolute">
                    <div id="toggle">
                        <div class="first-menu-line"></div>
                        <div class="second-menu-line"></div>
                        <div class="third-menu-line"></div>
                    </div>
                </div>
                <div class="clear"></div>	
            </div>