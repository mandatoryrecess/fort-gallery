<?php

function opta_options_admin_styles() {
    wp_enqueue_style('opta-wp-custom-admin-layout-css', get_template_directory_uri() . '/admin/css/layout.css');
}

if (is_admin()) {
    add_action('admin_print_styles', 'opta_options_admin_styles');
}
?>