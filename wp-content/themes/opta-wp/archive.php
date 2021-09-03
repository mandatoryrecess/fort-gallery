<?php get_header(); ?>

<div class="archive-title center-text">
    <h1 class="entry-title"><?php echo esc_html(opta_archive_title($title)); ?></h1>
</div>

<div class="blog-holder block center-relative content-1140">
    <?php
    $curent_post_num = 0;
    $published_posts = $wp_query->found_posts;

    if ($wp_query->query_vars["paged"] > 1) {
        $curent_post_num = ($wp_query->query["paged"] - 1) * get_option('posts_per_page');
    }
    ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php $curent_post_num++; ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('animate relative blog-item-holder center-relative'); ?> >
            <?php if (has_post_thumbnail($post->ID)) : ?>        
                <div class="post-thumbnail">
                    <a href="<?php the_permalink($post->ID); ?>"><?php echo get_the_post_thumbnail(); ?></a>
                </div>
                <div class="entry-holder">
                <?php else: ?>
                    <div class="entry-holder">
                    <?php endif; ?>
                    <div class="post-num"><span class="current-post"><?php echo esc_html($curent_post_num); ?></span><span class="separator">/</span><span class="total-posts"><?php echo esc_html($published_posts); ?></span></div>
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
                    <h2 class="entry-title"><a href="<?php the_permalink($post->ID); ?>"><?php the_title(); ?></a></h2>    
                    <p class="read-more-arrow"><a href="<?php the_permalink($post->ID); ?>"><img src="<?php echo esc_url(get_template_directory_uri()) . '/images/blog_arrow@2x.png' ?>" alt="<?php echo esc_attr__('Read More', 'opta-wp'); ?>"></a></p>
                </div>
                <div class="clear"></div>
        </article>   
        <?php
    endwhile;
    $big = 99999;
    echo '<div class="page-pagination-holder center-text">';
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', html_entity_decode(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_next' => false
    ));
    echo '</div>';
    ?>

</div>

<?php get_footer(); ?>