<?php
/**
 * Load scripts and styles
 */
function vue_wordpress_scripts() {
    $ver = '0.2';

    // Styles
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), $ver );
    // wp_enqueue_style( 'editor-style', get_template_directory_uri() . '/editor-style.css', array(), $ver ); 
    wp_enqueue_style('vue_wordpress', get_template_directory_uri() . '/dist/vue-wordpress.css', array(), $ver );

    // Scripts
    // Enable For Production - Disable for Development
    // wp_enqueue_script('vue_wordpress.js', get_template_directory_uri() . '/dist/vue-wordpress.js', array(), $ver, true );
    // Enable For Development - Remove for Production
    wp_enqueue_script( 'vue_wordpress.js', 'http://localhost:8085/vue-wordpress.js', array(), $ver, true );
}
add_action( 'wp_enqueue_scripts', 'vue_wordpress_scripts' );
    
