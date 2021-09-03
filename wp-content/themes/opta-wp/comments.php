<div id="comments" class="comments-holder">	
    <?php if (have_comments()) : ?>
        <div class="block center-relative content-750">
            <ol class="comments-list-holder">                 
                <?php wp_list_comments(array('max_depth' => 4, 'avatar_size' => 48, 'callback' => 'coco_basic_theme_comment', 'short_ping' => true)); ?>  
            </ol>
            
                <div class="comments-pagination-wrapper top-20 bottom-20">
                    <div class="comments-pagination">
                        <?php paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;')); ?> 
                    </div>
                </div>                        
        </div>                           
    <?php endif; ?>  
    <?php
    if (comments_open()) :
        echo '<div class="comment-form-holder">';
        echo '<div class="block center-relative content-750">';

        if (!isset($aria_req)) {
            $aria_req = '';
        }
        comment_form(
                array('fields' => array(
                        'author' => '<p class="custom-text-class">' . esc_html__('Name', 'opta-wp') . '</p><p class="comment-form-author custom-field-class">' .
                        '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="20"' . $aria_req . ' /></p>',
                        'email' => '<p class="custom-text-class">' . esc_html__('Email', 'opta-wp') . '</p><p class="comment-form-email custom-field-class">' .
                        '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="20"' . $aria_req . ' /></p>'
                    ),
                    'comment_field' => '<p class="custom-text-class">' . esc_html__('Write Comment...', 'opta-wp') . '</p><p class="comment-form-comment custom-field-class"><textarea id="comment" name="comment" cols="45" rows="12" aria-required="true"></textarea></p>',
                    'title_reply' => '',                    
                    'comment_notes_before' => '',
                    'comment_notes_after' => '',
                    'label_submit' => esc_html__('Send', 'opta-wp')));
        echo '</div></div>';
    endif;

    function coco_basic_theme_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="single-comment-holder">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php echo esc_html__('Your comment is awaiting moderation.', 'opta-wp'); ?></em>
                    <br /> <br />
                <?php endif; ?>

                <?php
                $get_comment_ID = get_comment_ID();
                $comment_id = get_comment($get_comment_ID);
                $parent_comment_id = $comment_id->comment_parent;
                if ($parent_comment_id != 0) {
                    $get_parent_author_name = get_comment_author($parent_comment_id);
                }
                ?>

                <div class="left vcard">
                    <?php
                    if ($args['avatar_size'] != 0)
                        echo get_avatar($comment, 70);
                    ?>
                </div>
                <div class="comment-right-holder">
                    <ul class="comment-author-date-replay-holder">
                        <li class="comment-author">
                            <?php echo comment_author(); ?>
                        </li>
                        <li class="comment-reply">
                            <?php comment_reply_link(array_merge($args, array('add_below' => '', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </li> 
                    </ul>
                    <p class="comment-date">
                        <?php comment_date('M j, Y g:i a'); ?>
                    </p>				
                    <div class="comment-text">
                        <?php
                        if ($parent_comment_id != 0) {
                            echo '<span class="replay-at-author">@' . esc_html($get_parent_author_name) . '</span>';
                        } comment_text();
                        ?>
                    </div>			
                </div>
                <div class="clear"></div>
            </div>              
    <?php } ?>
</div>