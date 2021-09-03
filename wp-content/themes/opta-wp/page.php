<?php get_header(); ?>

<div id="content" class="site-content">

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
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(''); ?> >
                <div class="content-945 center-relative">
                    <?php the_content(); ?>
                </div>
            </div>                
            <?php
            comments_template();
        endwhile;
    endif;
    ?>    

</div>

<?php get_footer(); ?>