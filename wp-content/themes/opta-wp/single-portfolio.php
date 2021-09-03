<?php get_header(); ?>

<div id="content" class="site-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            $allowed_html_array = opta_allowed_html();
            $header_content = get_post_meta($post->ID, "portfolio_header_content", true);
            $item_info = get_post_meta($post->ID, "portfolio_item_info", true);
            ?>		

            <div id="post-<?php the_ID(); ?>" <?php post_class('content-1140 center-relative'); ?>>                                              
                <div class="center-relative clear">                
                    <div class="entry-content">
                        <?php if ($header_content != ''): ?>
                            <div class="top-content">
                                <?php echo do_shortcode(wp_kses($header_content, $allowed_html_array)); ?>
                            </div>
                        <?php endif; ?>
                        <div class="content-970 center-relative">  
                            <div class="portfolio-item-info">
                                <?php
                                if ($item_info != '') {
                                    echo '<div class="item-info-content">';
                                    echo do_shortcode(wp_kses($item_info, $allowed_html_array));
                                    echo '</div>';
                                }

                                if (function_exists('ADDTOANY_SHARE_SAVE_KIT')) {
                                    echo '<div class="share-holder">';
                                    echo '<p class="share-text">' . esc_html__('Share', 'opta-wp') . '</p>' . do_shortcode('[addtoany]');
                                    echo '</div>';
                                }
                                ?>
                                <div class="portfolio-nav">
                                    <?php
                                    $prev_post = get_previous_post();
                                    if (is_a($prev_post, 'WP_Post')):
                                        ?>
                                        <div class="nav-previous">                        
                                            <?php previous_post_link('%link', '<img src="' . esc_url(get_template_directory_uri()) . '/images/opta_arrow@2x_left.png" alt="' . esc_attr__('Previous', 'opta-wp') . '" />'); ?>                                                                                        
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    $next_post = get_next_post();
                                    if (is_a($next_post, 'WP_Post')):
                                        ?>                
                                        <div class="nav-next">                        
                                            <?php next_post_link('%link', '<img src="' . esc_url(get_template_directory_uri()) . '/images/opta_arrow@2x.png" alt="' . esc_attr__('Next', 'opta-wp') . '" />'); ?>                                            
                                        </div>
                                    <?php endif; ?>
                                    <div class="clear"></div>
                                </div>                                
                            </div>
                            <div class="content-wrapper">
                                <?php the_content(); ?>      
                            </div>                                                        
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <?php
            comments_template();
        endwhile;
    endif;
    ?>    
</div>
<?php get_footer(); ?>