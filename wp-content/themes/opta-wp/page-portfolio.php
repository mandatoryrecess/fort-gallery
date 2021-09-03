<?php
/*
  Template Name: Portfolio
 */
?>

<?php get_header(); ?>

<?php
$page_title = get_post_meta($post->ID, "page_big_title", true);
$page_des = get_post_meta($post->ID, "page_des_title", true);
$allowed_html_array = opta_allowed_html();

if (wp_kses(get_post_meta($post->ID, "page_show_title", true), $allowed_html_array) !== 'no') {
    if (($page_title != '') || ($page_des != '')) {
        echo '<div class="content-1140 header-content center-relative block">';
        if ($page_title != '') {
            echo ' <h1 class="entry-title">' . wp_kses($page_title, $allowed_html_array) . '</h1>';
        } else {
            the_title('<h1 class="entry-title">', '</h1>');
        }

        if ($page_des != '') {
            echo '<p class="page-desc">' . wp_kses($page_des, $allowed_html_array) . '</p>';
        }
        echo '</div>';
    } else {
        the_title('<h1 class="entry-title">', '</h1>');
    }
}
?>

<?php
if (post_type_exists('portfolio')) {
    //plugin is activated

    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $posts_per_page = get_theme_mod('portfolio_num_items', 8);
    query_posts('post_type=portfolio&posts_per_page=' . $posts_per_page . '&paged=' . $page);

    if (have_posts()) :
        echo '<div id="content" class="site-content"><ul class="grid" id="portfolio">';
        require get_parent_theme_file_path('loop-portfolio.php');
        echo '</ul><div class="clear"></div><div class="block center-text load-more-portfolio"><a target="_self" class="more-posts-portfolio">' . esc_html__('Load More', 'opta-wp') . '</a></div>';
    endif;
    echo '<div class="clear"></div></div>';
}
else {
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <div id="content" class="site-content">
                <div id="post-<?php the_ID(); ?>" <?php post_class(''); ?> >
                    <div class="content-945 center-relative">
                        <?php the_content(); ?>
                    </div>
                </div>                
                <?php comments_template(); ?>                                    
            </div>
            <?php
        endwhile;
    endif;
}
?>   

<?php get_footer(); ?>