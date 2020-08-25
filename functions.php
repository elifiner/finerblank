<?php

add_filter( 'the_content', 'content_footer' );
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
add_action( 'widgets_init', 'widgets_init' );

function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function content_footer( $content ) {    
    // add a custom widget area to add some content to every post (usually a CTA)
    ob_start();
    dynamic_sidebar("Post Footer");
    $sidebar = ob_get_clean();
    $content .= '<p>'.$sidebar.'</p>';
    return $content;
}


function widgets_init() {
    register_sidebar(array(
        'name' => 'Post Footer',
        'id' => 'post-footer',
        'before_widget' => '<div class = "widgetizedArea">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
