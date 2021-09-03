<?php
get_header();
$queried_object = get_queried_object();
?>	

<div class="taxonomy-title center-text bottom-50">
    <h1 class="entry-title"><?php echo esc_html($queried_object->name); ?></h1>
</div>


<ul class="grid" id="portfolio">          

    <?php $portfolio_content = ''; ?>
    <?php while (have_posts()) : the_post(); ?>

        <?php
        if (has_post_thumbnail($post->ID)) {
            $portfolio_post_thumb = get_the_post_thumbnail();
        } else {
            $portfolio_post_thumb = '<img src = "' . esc_url(get_template_directory_uri()) . '/images/no-photo.png" alt = "' . esc_attr__('No Photo', 'opta-wp') . '" />';
        }

        $p_thumb_text = get_post_meta($post->ID, "portfolio_hover_thumb_text", true);
        $item_quote = get_post_meta($post->ID, "portfolio_item_quote", true);
        $link_thumb_to = get_post_meta($post->ID, "portfolio_link_item_to", true);
        $allowed_html_array = opta_allowed_html();


        if ($item_quote !== '') {
            switch ($link_thumb_to):
                case 'link_to_this_post':
                    $portfolio_content.= '<li class="grid-item element-item quote-item animate"><a href="' . get_the_permalink($post->ID) . '">' . $item_quote . '</a></li>';
                    break;
                case 'link_to_extern_url':
                    $extern_site_url = get_post_meta($post->ID, "portfolio_extern_site_url", true);
                    $portfolio_content.= '<li class="grid-item element-item quote-item animate"><a href="' . $extern_site_url . '" target="_blank">' . $item_quote . '</a></li>';
                    break;
                case 'no_link':
                    $portfolio_content.= '<li class="grid-item element-item quote-item animate">' . $item_quote . '</li>';
                    break;

                default:
                    $portfolio_content.= '<li class="grid-item element-item quote-item animate"><a href="' . get_the_permalink($post->ID) . '">' . $item_quote . '</a></li>';
            endswitch;
        } else {
            switch ($link_thumb_to):
                case 'link_to_this_post':
                    $portfolio_content.= '<li class="grid-item element-item animate"><div class="item-wrapper"><a href="' . get_the_permalink($post->ID) . '">' . $portfolio_post_thumb . '</a><div class="portfolio-text-holder"><div class="portfolio-info"><a class="portfolio-text" href="' . get_the_permalink($post->ID) . '">' . $p_thumb_text . '</a>' . opta_get_cat($post->ID) . '<p class="portfolio-arrow"><a href="' . get_the_permalink($post->ID) . '"><img src="' . esc_url(get_template_directory_uri()) . '/images/opta_arrow@2x.png" alt="' . esc_attr__('Read More', 'opta-wp') . '" /></a></p></div></div></div></li>';
                    break;
                case 'link_to_extern_url':
                    $extern_site_url = get_post_meta($post->ID, "portfolio_extern_site_url", true);
                    $portfolio_content.= '<li class="grid-item element-item animate"><div class="item-wrapper"><a href="' . $extern_site_url . '" target="_blank">' . $portfolio_post_thumb . '</a><div class="portfolio-text-holder"><div class="portfolio-info"><a class="portfolio-text" href="' . $extern_site_url . '" target="_blank">' . $p_thumb_text . '</a>' . opta_get_cat($post->ID) . '<p class="portfolio-arrow"><a href="' . $extern_site_url . '" target="_blank"><img src="' . esc_url(get_template_directory_uri()) . '/images/opta_arrow@2x.png" alt="' . esc_attr__('Read More', 'opta-wp') . '" /></a></p></div></div></div></li>';
                    break;
                case 'no_link':
                    $portfolio_content.= '<li class="grid-item element-item animate"><div class="item-wrapper"><a>' . $portfolio_post_thumb . '</a><div class="portfolio-text-holder"><div class="portfolio-info"><p class="portfolio-text"><a>' . $p_thumb_text . '</a></p>' . opta_get_cat($post->ID) . '</div></div></div></li>';
                    break;

                default:
                    $portfolio_content.= '<li class="grid-item element-item animate"><div class="item-wrapper"><a href="' . get_the_permalink($post->ID) . '">' . $portfolio_post_thumb . '</a><div class="portfolio-text-holder"><div class="portfolio-info"><a class="portfolio-text" href="' . get_the_permalink($post->ID) . '">' . $p_thumb_text . '</a>' . opta_get_cat($post->ID) . '<p class="portfolio-arrow"><a href="' . get_the_permalink($post->ID) . '"><img src="' . esc_url(get_template_directory_uri()) . '/images/opta_arrow@2x.png" alt="' . esc_attr__('Read More', 'opta-wp') . '" /></a></p></div></div></div></li>';
            endswitch;
        }

    endwhile;

    echo wp_kses($portfolio_content, $allowed_html_array);

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

</ul>

<?php get_footer(); ?>