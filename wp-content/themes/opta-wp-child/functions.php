<?php

function opta_wp_child_enqueue_styles() {
    wp_enqueue_style('opta-main-theme-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('opta-child-main-theme-style', get_stylesheet_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'opta_wp_child_enqueue_styles', 11);

function opta_child_lang_setup() {
    load_child_theme_textdomain('opta-wp', get_stylesheet_directory() . '/languages');
}

add_action('after_setup_theme', 'opta_child_lang_setup');
?>