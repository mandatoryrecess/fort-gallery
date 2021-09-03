<!--Footer-->

<?php
$allowed_html_array = opta_allowed_html();
?>

<footer class="footer">
    <div class="footer-content content-1140 center-relative">	
        <div class="footer-logo">
            <?php if (get_option('opta_footer_logo') !== ''): ?>                         
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url(get_option('opta_footer_logo', get_template_directory_uri() . '/images/footer_logo_@x2.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                </a>               
            <?php endif; ?>                  
        </div>
        <?php if ((get_theme_mod('footer_mail') != '') || (get_theme_mod('footer_mail_sec') != '')): ?>
            <div class="footer-text">
                <p class="footer-first-line">
                    <?php
                    if (get_theme_mod('footer_mail') != ''):
                        echo wp_kses(__(get_theme_mod('footer_mail') ? get_theme_mod('footer_mail') : '<a href="#">hello@yoursite.com</a>', 'opta-wp'), $allowed_html_array);
                    endif;
                    ?>                
                </p>
                <p class="footer-second-line">
                    <?php
                    if (get_theme_mod('footer_mail_sec') != ''):
                        echo wp_kses(__(get_theme_mod('footer_mail_sec') ? get_theme_mod('footer_mail_sec') : 'or can use our <a href="#">contact form</a> as well', 'opta-wp'), $allowed_html_array);
                    endif;
                    ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if ((get_theme_mod('footer_lat') != '') || (get_theme_mod('footer_lng') != '')): ?>
            <div class="our-position-holder">
                <div class="our-position-left">
                    <p class="position-lat">
                        <?php
                        if (get_theme_mod('footer_lat') != ''):
                            echo wp_kses(__(get_theme_mod('footer_lat') ? get_theme_mod('footer_lat') : '<a href="#" target="_blank">40.758896 N</a>', 'opta-wp'), $allowed_html_array);
                        endif;
                        ?>                    
                    </p>
                </div>
                <div class="our-position-right">
                    <p class="position-lng">
                        <?php
                        if (get_theme_mod('footer_lng') != ''):
                            echo wp_kses(__(get_theme_mod('footer_lng') ? get_theme_mod('footer_lng') : '<a href="#" target="_blank">-73.985130 W</a>', 'opta-wp'), $allowed_html_array);
                        endif;
                        ?>                       
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
        <?php if (is_active_sidebar('footer-sidebar')) : ?>
            <ul id="footer-sidebar">
                <?php dynamic_sidebar('footer-sidebar'); ?>
            </ul>
        <?php endif; ?>  
        <?php if ((get_theme_mod('footer_copyright_content') != '') || (get_theme_mod('footer_social_content') != '')): ?>
            <ul class="copyright-holder">
                <li class="copyright-footer">
                    <?php
                    if (get_theme_mod('footer_copyright_content') != ''):
                        echo wp_kses(__(get_theme_mod('footer_copyright_content') ? get_theme_mod('footer_copyright_content') : '2017 - COCO + BASIC', 'opta-wp'), $allowed_html_array);
                    endif;
                    ?>
                </li>
                <li class="social-footer">                
                    <?php
                    if (get_theme_mod('footer_social_content') != ''):
                        echo wp_kses(__(get_theme_mod('footer_social_content') ? get_theme_mod('footer_social_content') : '<a href="#">TWITTER</a><a href="#">FACEBOOK</a><a href="#">INSTAGRAM</a><a href="#">BEHANCE</a>', 'opta-wp'), $allowed_html_array);
                    endif;
                    ?>
                </li>            
            </ul>
        <?php endif; ?>  
    </div>
</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>