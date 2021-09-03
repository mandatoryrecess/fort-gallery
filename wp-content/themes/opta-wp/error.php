<?php get_header(); ?>

<div class="center-text">
    <?php
    $allowed_tags = array(
        'a' => array(
            'class' => array(),
            'href' => array(),
            'rel' => array(),
            'title' => array(),
            'onclick' => array(),
        ),
        'p' => array(),
        'strong' => array()
    );

    echo wp_kses($message, $allowed_tags);
    ?>
</div>

<?php get_footer(); ?>