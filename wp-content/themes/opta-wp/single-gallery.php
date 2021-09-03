<?php get_header(); ?>

<div id="content" class="site-content center-relative">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>		

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="center-relative clear">           

                    <div class="entry-content">
                        <div class="content-750 center-relative">
                            <?php the_content(); ?>
                            <?php if (has_tag()): ?>	
                                <div class="tags-holder">
                                    <?php the_tags('', ''); ?>
                                </div>                              
                                <?php
                            endif;

                            $defaults = array(
                                'before' => '<p class="wp-link-pages top-50"><span>' . esc_html__('Pages:', 'opta-wp') . '</span>',
                                'after' => '</p>'
                            );
                            wp_link_pages($defaults);
                            ?>
                        </div>
                    </div>                   
                    <div class="clear"></div>
                </div>
            </article>
            <div class="nav-links content-750 center-relative">                
                <?php
                $prev_post = get_previous_post();
                if (is_a($prev_post, 'WP_Post')):
                    ?>
                    <div class="nav-previous">                        
                        <p><?php echo esc_html__('PREVIOUS STORY', 'opta-wp'); ?></p>                        
                        <?php previous_post_link('%link'); ?>                         
                        <div class="clear"></div>
                    </div>
                <?php endif; ?>
                <?php
                $next_post = get_next_post();
                if (is_a($next_post, 'WP_Post')):
                    ?>                
                    <div class="nav-next">
                        <p><?php echo esc_html__('NEXT STORY', 'opta-wp'); ?></p>                        
                        <?php next_post_link('%link'); ?>                     
                        <div class="clear"></div>
                    </div>
                <?php endif; ?>
                <div class="clear"></div>
            </div>

            <?php
            comments_template();
        endwhile;
    endif;
    ?>    
</div>
<?php get_footer(); ?>