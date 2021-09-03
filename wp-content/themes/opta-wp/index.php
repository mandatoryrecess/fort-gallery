<?php get_header(); ?>


<?php
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('post_type=post&paged=' . $page);

if (have_posts()) :
    echo '<div class="blog-holder block center-relative content-1140">';
    require get_parent_theme_file_path( 'loop-index.php' );
    echo '</div><div class="clear"></div><div class="block center-relative center-text load-more-posts"><a target="_self" class="more-posts-index">' . esc_html__('Load More', 'opta-wp') . '</a></div>';
endif;
echo '<div class="clear"></div>';
?>   

<?php get_footer(); ?>