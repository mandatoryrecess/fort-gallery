<?php get_header(); ?>	

<div class="search-title center-text bottom-50">
    <h1 class="entry-title"><?php echo get_search_query(); ?></h1>
</div>

<div class="blog-holder block center-relative content-1140">          
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('relative blog-item-holder center-relative'); ?> >
                <h2 class="entry-title"><a href="<?php the_permalink($post->ID); ?>"><?php the_title(); ?></a></h2> 
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
    else:
        echo '<h2>' . esc_html__("No results", 'opta-wp') . '</h2>';
    endif;
    ?>

</div>


<?php get_footer(); ?>