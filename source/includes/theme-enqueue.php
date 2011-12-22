<?php

################################################################################
// Enqueue Scripts
################################################################################

function init_scripts() {
    wp_deregister_script( 'jquery' );
    wp_deregister_script( 'comment-reply' );
    
    // Register Scripts
    //wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/jquery/1.6.2/jquery.min.js');
    wp_register_script( 'jquery', get_bloginfo('template_url') . '/javascripts/jquery-1.7.min.js', false, '1.7', true);

    wp_register_script( 'comment-reply', get_bloginfo('url') . '/wp-includes/js/comment-reply.js');
    wp_register_script('modernizr', get_bloginfo('template_url') . '/javascripts/modernizr-2.0.6.min.js');

    // Queue s
    wp_enqueue_script('modernizr');
    wp_enqueue_script('jquery');
    //wp_enqueue_script('slides_js', get_bloginfo('template_directory') . '/js/slides.min.jquery.js', '', '1.1.8', true );
    //wp_enqueue_script('iframe_auto_height', get_bloginfo('template_directory') . '/js/jquery.iframe-auto-height.plugin.1.5.0.min.js', '', '1.5.0', true );
    if ( get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply',  get_bloginfo('url') . '/wp-includes/js/comment-reply.js', 'jquery', '', true );
    
    wp_enqueue_script('jquery-admin', get_bloginfo('template_url') . '/javascripts/admin.js', 'jquery', '', true);
    wp_enqueue_script('jquery-theme', get_bloginfo('template_url') . '/javascripts/theme.js', 'jquery', '', true);
}    
function footer_scripts() {
    
    ?>
    <!--[if lt IE 7 ]><script src="<?php bloginfo('template_url'); ?>/javascripts/dd_belatedpng.js?v=1"></script><![endif]-->

    <?php 
}

if (!is_admin()) add_action('init', 'init_scripts', 0);
add_action('wp_footer', 'footer_scripts', 10);
