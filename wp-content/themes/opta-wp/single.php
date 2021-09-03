<?php
get_header();
$count_posts = wp_count_posts();
$published_posts = $count_posts->publish;
?>

<div id="content" class="site-content center-relative">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>		

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="center-relative clear">

                    <div class="entry-info">
                        <div class="entry-info-left">
                            <div class="cat-links">
                                <ul>
                                    <?php
                                    foreach ((get_the_category()) as $category) {
                                        echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>                    
                            <div class="entry-date published"><?php echo get_the_date('F j, Y'); ?></div>       
                        </div>
                        <div class="entry-info-right">
                            <?php if (comments_open()) : ?>
                                <div class="num-comments"><a href="<?php comments_link(); ?>"><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></a></div>
                            <?php endif; ?>  
                            <div class="author-nickname">
                                <?php the_author_posts_link(); ?>
                            </div>   
                        </div>
                    </div>

                    <div class="post-num"><span class="current-post"><?php echo esc_html(opta_get_post_number($post->ID)); ?></span><span class="separator">/</span><span class="total-posts"><?php echo esc_html($published_posts); ?></span></div>

                    <div class="entry-content">
                        <div class="content-750 center-relative">
                            <?php
                            if (has_post_thumbnail()):
                                if (esc_html(get_post_meta($post->ID, "post_show_featured_image", true)) !== 'no'):
                                    ?>
                                    <div class="single-post-featured-image">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php
                            the_content();

                            $defaults = array(
                                'before' => '<p class="wp-link-pages top-50"><span>' . esc_html__('Pages:', 'opta-wp') . '</span>',
                                'after' => '</p>'
                            );
                            wp_link_pages($defaults);

                            if (has_tag()):
                                ?>	
                                <div class="tags-holder">
                                    <?php the_tags('', ''); ?>
                                </div>                              
                                <?php
                            endif;
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