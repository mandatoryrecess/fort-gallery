<?php

/*
  Plugin Name: CocoBasic - Opta WP
  Description: User interface used in Opta WP theme.
  Version: 1.5
  Author: CocoBasic
  Author URI: https://www.cocobasic.com
 */


if (!defined('ABSPATH'))
    die("Can't load this file directly");

class Opta_shortcodes {

    function __construct() {
        add_action('init', array($this, 'myplugin_load_textdomain'));
        if ((version_compare(get_bloginfo('version'), '5.0', '<')) || (class_exists( 'Classic_Editor' )) ) {
            add_action('admin_init', array($this, 'opta_action_admin_init'));
        }
    }

    function opta_action_admin_init() {
        if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
            add_filter('mce_buttons', array($this, 'opta_filter_mce_button'));
            add_filter('mce_external_plugins', array($this, 'opta_filter_mce_plugin'));
        }
    }

    function opta_filter_mce_button($buttons) {
        // add a separation before the new button
        array_push($buttons, '|', 'cocobasic_shortcodes_button');
        return $buttons;
    }

    function opta_filter_mce_plugin($plugins) {
        // this plugin file will work the magic of our button
        $plugins['shortcodes_options'] = plugin_dir_url(__FILE__) . 'editor_plugin.js';
        return $plugins;
    }

    function myplugin_load_textdomain() {
        load_plugin_textdomain('cocobasic-shortcode', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

}

$opta_shortcodes = new opta_shortcodes();

add_theme_support('post-thumbnails', array('portfolio', 'gallery'));
add_action('add_meta_boxes', 'opta_add_page_custom_meta_box');
add_action('add_meta_boxes', 'opta_add_portfolio_custom_meta_box');
add_action('add_meta_boxes', 'opta_add_post_custom_meta_box');
add_action('save_post', 'opta_save_page_custom_meta');
add_action('save_post', 'opta_save_portfolio_custom_meta');
add_action('save_post', 'opta_save_post_custom_meta');
add_filter("the_content", "opta_the_content_filter");
add_action('init', 'opta_allowed_plugin_html');

//<editor-fold defaultstate="collapsed" desc="Columns short code">
function opta_col($atts, $content = null) {
    extract(shortcode_atts(array(
        "size" => 'one',
        "class" => ''
                    ), $atts));

    switch ($size) {
        case "one":
            $return = '<div class = "one ' . $class . '">
    ' . do_shortcode($content) . '
    </div><div class = "clear"></div>';
            break;
        case "one_half_last":
            $return = '<div class = "one_half last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        case "one_third_last":
            $return = '<div class = "one_third last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        case "two_third_last":
            $return = '<div class = "two_third last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        case "one_fourth_last":
            $return = '<div class = "one_fourth last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        case "three_fourth_last":
            $return = '<div class = "three_fourth last ' . $class . '">' . do_shortcode($content) . '</div><div class = "clear"></div>';
            break;
        default:
            $return = '<div class = "' . $size . ' ' . $class . '">' . do_shortcode($content) . '</div>';
    }

    return $return;
}

add_shortcode("col", "opta_col");

// </editor-fold>
//<editor-fold defaultstate="collapsed" desc="BR short code">
function opta_br($atts, $content = null) {
    return '<br />';
}

add_shortcode("br", "opta_br");

//</editor-fold>
//<editor-fold defaultstate="collapsed" desc="Full Page Width">
function opta_full_page($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    return '</div><div class="full-page-width center-relative' . $class . '">' . do_shortcode($content) . '</div><div class="content-945 center-relative">';
}

add_shortcode("full_page", "opta_full_page");

//</editor-fold>
//<editor-fold defaultstate="collapsed" desc="Full Post Width">
function opta_full_post($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    return '</div><div class="full-post-width center-relative' . $class . '">' . do_shortcode($content) . '</div><div class="content-750 center-relative">';
}

add_shortcode("full_post", "opta_full_post");

//</editor-fold>
//<editor-fold defaultstate="collapsed" desc="Box Page Width">
function opta_box_page($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    return '</div><div class="box-page-width content-1140 center-relative' . $class . '">' . do_shortcode($content) . '</div><div class="content-945 center-relative">';
}

add_shortcode("box_page", "opta_box_page");

//</editor-fold>
//<editor-fold defaultstate="collapsed" desc="Box Post Width">
function opta_box_post($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    return '</div><div class="box-post-width content-1140 center-relative' . $class . '">' . do_shortcode($content) . '</div><div class="content-750 center-relative">';
}

add_shortcode("box_post", "opta_box_post");

//</editor-fold>
// <editor-fold defaultstate="collapsed" desc="Skills short code">
function opta_skills($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "title" => '',
        "percent" => '50%'
                    ), $atts));

    $return = '<div class="progress_bar ' . $class . '">
               <div class="progress_bar_title">' . $title . '</div>               
               <div class="progress_bar_field_holder">   
               <div class="progress_bar_field_perecent" style="width:' . $percent . ';"></div>    
               </div>              
               </div>';
    return $return;
}

add_shortcode("skills", "opta_skills");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Info short code">
function opta_info($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "title" => ''
                    ), $atts));

    $return = '<div class="info-code ' . $class . '">
               <p class="info-code-title">' . $title . '</p>               
               <p class="info-code-content">' . do_shortcode($content) . '</p>
               </div>';
    return $return;
}

add_shortcode("info", "opta_info");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Big Font short code">
function opta_big_font($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    $return = '<h2 class="big-text ' . $class . '"> ' . $content . '</h2>';

    return $return;
}

add_shortcode("big_font", "opta_big_font");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Slider holder short code">
function opta_image_slider($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "name" => 'slider',
        "auto" => 'true',
        "hover_pause" => 'true',
        "speed" => '2000',
        "dots" => 'true'
                    ), $atts));


    $return = '<script> var ' . $name . '_speed = "' . $speed . '";
                var ' . $name . '_auto = "' . $auto . '";                
                var ' . $name . '_hover = "' . $hover_pause . '";
                var ' . $name . '_dots = "' . $dots . '";
    </script>
    <div class="image-slider-wrapper relative">
    <div id = ' . $name . ' class = "image-slider slider ' . $class . '">
            ' . do_shortcode($content) . '
        </div>';


    $return .= '<div class = "clear"></div></div>';

    return $return;
}

add_shortcode("image_slider", "opta_image_slider");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Slide Image short code">
function opta_image_slide($atts, $content = null) {
    extract(shortcode_atts(array(
        "img" => '',
        "href" => '',
        "alt" => '',
        "target" => '_self'
                    ), $atts));
    if ($href != '') {
        return '<div><a href="' . $href . '" target="' . $target . '"><img src = "' . $img . '" alt = "' . $alt . '" /></a></div>';
    } else {
        return '<div><img src = "' . $img . '" alt = "' . $alt . '" /></div>';
    }
}

add_shortcode("image_slide", "opta_image_slide");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Text holder short code">
function opta_text_slider($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => '',
        "name" => 'textslider',
        "auto" => 'true',
        "hover_pause" => 'true',
        "speed" => '2000',
        "dots" => 'true'
                    ), $atts));


    $return = '<script> var ' . $name . '_speed = "' . $speed . '";
                var ' . $name . '_auto = "' . $auto . '";                
                var ' . $name . '_hover = "' . $hover_pause . '";                
                var ' . $name . '_dots = "' . $dots . '";
    </script>
    
 <div class="testimonial-slider-holder relative ' . $class . '">                             
        <div id="' . $name . '" class="testimonial-slider slider">
            ' . do_shortcode($content) . '
        </div>';


    $return .= '</div>';

    return $return;
}

add_shortcode("text_slider", "opta_text_slider");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Text slide short code">
function opta_text_slide($atts, $content = null) {
    extract(shortcode_atts(array(
        "class" => ''
                    ), $atts));

    return '<div class = "testimonial-content ' . $class . '">
        ' . do_shortcode($content) . '
        </div>';
}

add_shortcode("text_slide", "opta_text_slide");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Gallery short code">
function opta_gallery_slider($atts, $content = null) {
    extract(shortcode_atts(array(
        "speed" => '1000',
        "auto" => 'true'
                    ), $atts));
    global $post;

    $gallery_content = '<script>
               var gallery_speed = "' . $speed . '";
               var gallery_auto = "' . $auto . '";
            </script>';

    $gallery_content .= '<div class = "carousel-slider slider">';

    global $wp_query;
    $temp_query = $wp_query;
    $args = array('post_type' => 'gallery', 'posts_per_page' => '-1');
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();

        if (has_post_thumbnail($post->ID)) {
            $gallery_post_thumb = get_the_post_thumbnail($post->ID, 'large');
        } else {
            $gallery_post_thumb = '<img src = "' . get_template_directory_uri() . '/images/no-photo.png" alt = "" />';
        }

        $gallery_content .= '<div class="gallery-item">' . $gallery_post_thumb . '<p class="item-text"><a href="' . get_permalink() . '">' . get_the_title() . '</a></p></div>';

    endwhile;

    $gallery_content .= '</div>';

    wp_reset_postdata();
    $wp_query = $temp_query;
    return $gallery_content;
}

add_shortcode("gallery_slider", "opta_gallery_slider");

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Register custom 'portfolio' post type">
function create_portfolio() {
    $portfolio_args = array(
        'label' => 'Portfolio',
        'singular_label' => 'Portfolio',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'supports' => array('title', 'editor', 'comments', 'custom-fields', 'thumbnail', 'excerpt'),
        'show_in_rest' => true
    );
    register_post_type('portfolio', $portfolio_args);
}

add_action('init', 'create_portfolio');

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Register custom 'gallery' post type">
function create_gallery() {
    $gallery_args = array(
        'label' => 'Gallery',
        'singular_label' => 'Gallery',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'supports' => array('title', 'editor', 'comments', 'custom-fields', 'thumbnail'),
        'show_in_rest' => true
    );
    register_post_type('gallery', $gallery_args);
}

add_action('init', 'create_gallery');

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Register Portfolio category">
function create_portfolio_taxonomies() {
    $labels = array(
        'name' => 'Portfolio Category',
        'singular_name' => 'Portfolio Category',
        'search_items' => 'Search Portfolio Category',
        'all_items' => 'All Categories',
        'parent_item' => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item' => 'Edit Portfolio Category',
        'update_item' => 'Update Portfolio Category',
        'add_new_item' => 'Add New Portfolio Category',
        'new_item_name' => 'New Portfolio Category',
        'menu_name' => 'Portfolio Category',
    );
    register_taxonomy('portfolio-category', array('portfolio'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'portfolio-category'),
        'show_in_rest' => true
    ));
}

add_action('init', 'create_portfolio_taxonomies');

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Add the Meta Box to 'Portfolio' posts"> 
function opta_add_portfolio_custom_meta_box() {
    add_meta_box(
            'cocobasic_portfolio_custom_meta_box', // $id  
            esc_html__('Portfolio Preference', 'cocobasic-shortcode'), // $title   
            'opta_show_portfolio_custom_meta_box', // $callback  
            'portfolio', // $page  
            'normal', // $context  
            'high'); // $priority     
}

// Field Array Post Page 
$prefix = 'portfolio_';
$portfolio_custom_meta_fields = array(
    array(
        'label' => esc_html__('Thumb text on mouse over', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'hover_thumb_text',
        'type' => 'text'
    ),
    array(
        'label' => esc_html__('Link Thumb/Quote to', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'link_item_to',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => esc_html__('This post', 'cocobasic-shortcode'),
                'value' => 'link_to_this_post'
            ),
            'two' => array(
                'label' => esc_html__('External URL', 'cocobasic-shortcode'),
                'value' => 'link_to_extern_url'
            ),
            'three' => array(
                'label' => esc_html__('No Link', 'cocobasic-shortcode'),
                'value' => 'no_link'
            )
        )
    ),
    array(
        'label' => esc_html__('Link thumb to External URL:', 'cocobasic-shortcode'),
        'desc' => esc_html__('Set URL to external site', 'cocobasic-shortcode'),
        'id' => $prefix . 'extern_site_url',
        'type' => 'text'
    ),
    array(
        'label' => esc_html__('Item Quote', 'cocobasic-shortcode'),
        'desc' => esc_html__('If you want to use text instant Featured Image', 'cocobasic-shortcode'),
        'id' => $prefix . 'item_quote',
        'type' => 'textarea'
    ),
    array(
        'label' => esc_html__('Item Info', 'cocobasic-shortcode'),
        'desc' => esc_html__('Item/Project Inormation', 'cocobasic-shortcode'),
        'id' => $prefix . 'item_info',
        'type' => 'textarea'
    ),
    array(
        'label' => esc_html__('Header Content', 'cocobasic-shortcode'),
        'desc' => esc_html__('(Above Item Info)', 'cocobasic-shortcode'),
        'id' => $prefix . 'header_content',
        'type' => 'textarea'
    )
);

// The Callback  
function opta_show_portfolio_custom_meta_box() {
    global $portfolio_custom_meta_fields, $post;
    $allowed_plugin_tags = opta_allowed_plugin_html();
// Use nonce for verification  
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . esc_attr(wp_create_nonce(basename(__FILE__))) . '" />';
// Begin the field table and loop  
    echo '<table class="form-table">';
    foreach ($portfolio_custom_meta_fields as $field) {
// get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);
// begin a table row with  
        echo '<tr> 
                <th><label for="' . esc_attr($field['id']) . '">' . esc_attr($field['label']) . '</label></th> 
                <td>';
        switch ($field['type']) {
// case items will go here  
// text  
            case 'text':

                if ($field['id'] == 'portfolio_extern_site_url') {
                    echo '<input type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_url($meta) . '" size="50" /> 
						<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                } else {
                    echo '<input type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
						<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                }
                break;
// select  
            case 'select':
                echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . esc_attr($option['value']) . '">' . esc_html($option['label']) . '</option>';
                }
                echo '</select><br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
// textarea  
            case 'textarea':
                echo '<textarea name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" cols="60" rows="4">' . wp_kses($meta, $allowed_plugin_tags) . '</textarea> 
					<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
        } //end switch  
        echo '</td></tr>';
    } // end foreach  
    echo '</table>'; // end table  
}

// Save the Data  
function opta_save_portfolio_custom_meta($post_id) {
    global $portfolio_custom_meta_fields;
    $allowed_plugin_tags = opta_allowed_plugin_html();
// verify nonce  
    if (isset($_POST['custom_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
// check autosave  
// Stop WP from clearing custom fields on autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;

    if ( 'portfolio' !== get_post_type() ) {
        return $post_id;
    }

// check permissions  
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
// loop through fields and save the data  
    foreach ($portfolio_custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = null;
        if (isset($_POST[$field['id']])) {
            $new = $_POST[$field['id']];
        }
        if ($new && $new != $old) {
            $new = wp_kses($new, $allowed_plugin_tags);
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach  
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Add the Meta Box to 'Posts' regular"> 
function opta_add_post_custom_meta_box() {
    add_meta_box(
            'cocobasic_post_custom_meta_box', // $id  
            esc_html__('Post Preference', 'cocobasic-shortcode'), // $title   
            'opta_show_post_custom_meta_box', // $callback  
            'post', // $page  
            'normal', // $context  
            'high'); // $priority     
}

// Field Array Post Page 
$prefix = 'post_';
$post_custom_meta_fields = array(
    array(
        'label' => esc_html__('Show Featured Image on Single Post', 'cocobasic-shortcode'),
        'desc' => esc_html__('Note: Featured image on Blog page will be still visible', 'cocobasic-shortcode'),
        'id' => $prefix . 'show_featured_image',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => esc_html__('Yes', 'cocobasic-shortcode'),
                'value' => 'yes'
            ),
            'two' => array(
                'label' => esc_html__('No', 'cocobasic-shortcode'),
                'value' => 'no'
            )
        )
    )
);

// The Callback  
function opta_show_post_custom_meta_box() {
    global $post_custom_meta_fields, $post;
    $allowed_plugin_tags = opta_allowed_plugin_html();
// Use nonce for verification  
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . esc_attr(wp_create_nonce(basename(__FILE__))) . '" />';
// Begin the field table and loop  
    echo '<table class="form-table">';
    foreach ($post_custom_meta_fields as $field) {
// get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);
// begin a table row with  
        echo '<tr> 
                <th><label for="' . esc_attr($field['id']) . '">' . esc_attr($field['label']) . '</label></th> 
                <td>';
        switch ($field['type']) {
// case items will go here  
// select  
            case 'select':
                echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . esc_attr($option['value']) . '">' . esc_html($option['label']) . '</option>';
                }
                echo '</select><br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
        } //end switch  
        echo '</td></tr>';
    } // end foreach  
    echo '</table>'; // end table  
}

// Save the Data  
function opta_save_post_custom_meta($post_id) {
    global $post_custom_meta_fields;
    $allowed_plugin_tags = opta_allowed_plugin_html();
// verify nonce  
    if (isset($_POST['custom_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
// check autosave  
// Stop WP from clearing custom fields on autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;

    if ( 'post' !== get_post_type() ) {
        return $post_id;
    }

// check permissions  
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
// loop through fields and save the data  
    foreach ($post_custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = null;
        if (isset($_POST[$field['id']])) {
            $new = $_POST[$field['id']];
        }
        if ($new && $new != $old) {
            $new = wp_kses($new, $allowed_plugin_tags);
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach  
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Add the Meta Box to 'Pages'"> 
function opta_add_page_custom_meta_box() {
    add_meta_box(
            'cocobasic_page_custom_meta_box', // $id  
            esc_html__('Page Preference', 'cocobasic-shortcode'), // $title   
            'opta_show_page_custom_meta_box', // $callback  
            'page', // $page  
            'normal', // $context  
            'high'); // $priority     
}

// Field Array Post Page 
$prefix = 'page_';
$page_custom_meta_fields = array(
    array(
        'label' => esc_html__('Show Page Title', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'show_title',
        'type' => 'select',
        'options' => array(
            'one' => array(
                'label' => esc_html__('Yes', 'cocobasic-shortcode'),
                'value' => 'yes'
            ),
            'two' => array(
                'label' => esc_html__('No', 'cocobasic-shortcode'),
                'value' => 'no'
            )
        )
    ),
    array(
        'label' => esc_html__('Custom Page title', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'big_title',
        'type' => 'textarea'
    ),
    array(
        'label' => esc_html__('Page description', 'cocobasic-shortcode'),
        'desc' => '',
        'id' => $prefix . 'des_title',
        'type' => 'text'
    )
);

// The Callback  
function opta_show_page_custom_meta_box() {
    global $page_custom_meta_fields, $post;
    $allowed_plugin_tags = opta_allowed_plugin_html();
// Use nonce for verification  
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . esc_attr(wp_create_nonce(basename(__FILE__))) . '" />';
// Begin the field table and loop  
    echo '<table class="form-table">';
    foreach ($page_custom_meta_fields as $field) {
// get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);
// begin a table row with  
        echo '<tr> 
                <th><label for="' . esc_attr($field['id']) . '">' . esc_attr($field['label']) . '</label></th> 
                <td>';
        switch ($field['type']) {
// case items will go here  
// text  
            case 'text':
                echo '<input type="text" name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" value="' . esc_attr($meta) . '" size="50" /> 
        <br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
// select  
            case 'select':
                echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="' . esc_attr($option['value']) . '">' . esc_html($option['label']) . '</option>';
                }
                echo '</select><br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
// textarea  
            case 'textarea':
                echo '<textarea name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" cols="60" rows="4">' . wp_kses($meta, $allowed_plugin_tags) . '</textarea> 
					<br /><span class="description">' . esc_html($field['desc']) . '</span>';
                break;
        } //end switch  
        echo '</td></tr>';
    } // end foreach  
    echo '</table>'; // end table  
}

// Save the Data  
function opta_save_page_custom_meta($post_id) {
    global $page_custom_meta_fields;
    $allowed_plugin_tags = opta_allowed_plugin_html();
// verify nonce  
    if (isset($_POST['custom_meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
// check autosave  
// Stop WP from clearing custom fields on autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// Prevent quick edit from clearing custom fields
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;

    if ( 'page' !== get_post_type() ) {
        return $post_id;
    }

// check permissions  
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
// loop through fields and save the data  
    foreach ($page_custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = null;
        if (isset($_POST[$field['id']])) {
            $new = $_POST[$field['id']];
        }
        if ($new && $new != $old) {
            $new = wp_kses($new, $allowed_plugin_tags);
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach  
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Get Portfolio Item Categories"> 
function opta_get_cat($postID) {
    $args = array('hide_empty=0');

    if ($postID !== 'all') {
        $terms = wp_get_post_terms($postID, 'portfolio-category', $args);
    } else {
        $terms = get_terms('portfolio-category', $args);
    }

    if (!empty($terms) && !is_wp_error($terms)) {
        $count = count($terms);
        $i = 0;
        $term_list = '<p class="portfolio-category">';
        foreach ($terms as $term) {
            $i++;
            $term_list .= '<a href="' . esc_url(get_term_link($term)) . '">' . $term->name . '</a>';
            if ($count < $i) {
                $term_list .= '</p>';
            }
        }
        return $term_list;
    }
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Shortcodes p-tag fix">
function opta_the_content_filter($content) {
    // array of custom shortcodes requiring the fix 
    $block = join("|", array("col", "image_slider", "image_slide", "text_slider", "text_slide", "skills", "info", "box_page", "box_post", "full_page", "full_post"));
    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);

    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep);
    return $rep;
}

//</editor-fold>
// <editor-fold defaultstate="collapsed" desc="Allowed HTML Tags">
function opta_allowed_plugin_html() {
    $allowed_tags = array(
        'a' => array(
            'class' => array(),
            'href' => array(),
            'rel' => array(),
            'title' => array(),
            'target' => array(),
            'data-rel' => array(),
        ),
        'abbr' => array(
            'title' => array(),
        ),
        'b' => array(),
        'blockquote' => array(
            'cite' => array(),
        ),
        'cite' => array(
            'title' => array(),
        ),
        'code' => array(),
        'del' => array(
            'datetime' => array(),
            'title' => array(),
        ),
        'dd' => array(),
        'div' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'br' => array(),
        'dl' => array(),
        'dt' => array(),
        'em' => array(),
        'h1' => array(
            'class' => array(),
        ),
        'h2' => array(
            'class' => array(),
        ),
        'h3' => array(
            'class' => array(),
        ),
        'h4' => array(
            'class' => array(),
        ),
        'h5' => array(
            'class' => array(),
        ),
        'h6' => array(
            'class' => array(),
        ),
        'i' => array(),
        'img' => array(
            'alt' => array(),
            'class' => array(),
            'height' => array(),
            'src' => array(),
            'width' => array(),
        ),
        'li' => array(
            'class' => array(),
        ),
        'ol' => array(
            'class' => array(),
        ),
        'p' => array(
            'class' => array(),
        ),
        'q' => array(
            'cite' => array(),
            'title' => array(),
        ),
        'span' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'strike' => array(),
        'strong' => array(),
        'ul' => array(
            'class' => array(),
        ),
        'iframe' => array(
            'class' => array(),
            'src' => array(),
            'allowfullscreen' => array(),
            'width' => array(),
            'height' => array(),
        )
    );

    return $allowed_tags;
}

//</editor-fold>
?>