<?php
add_action( 'after_setup_theme', 'vue_wordpress_setup' );
/**
 * Declare REST API Data Localizer dependency
 * https://gitverse.ru/solj/rest-api-data-localizer
 */
if ( !class_exists( 'RADL' ) ) {
    add_action( 'admin_notices', function () {
        echo '<div class="error"><p>REST API Data Localizer не активирован. Чтобы использовать эту тему, перейдите в раздел  <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">плагины</a>, чтобы загрузить и/или активировать REST API Data Localizer.</p></div>';
    } );
    return;
}


/**
 * Инициализируем REST API Data Localizer
 */
new RADL( '__VUE_WORDPRESS__', 'vue_wordpress.js', array(
    'routing' => RADL::callback( 'vue_wordpress_routing' ),
    'state' => array(
        'media' => RADL::endpoint( 'media' ),
        'menus' => RADL::callback( 'vue_wordpress_menus' ),
        'pages' => RADL::endpoint( 'pages' ),
        'posts' => RADL::endpoint( 'posts' ),
        'users' => RADL::endpoint( 'users' ),
        'categories' => RADL::endpoint( 'categories' ),
        'site' => RADL::callback( 'vue_wordpress_site' ),
        'demo' => RADL::endpoint( 'demo' ), // Пример добавления кастомного типа записи
    ),
) );


/**
 * REST API Data Localizer callbacks
 */
function vue_wordpress_routing() {
    $routing = array(
        'category_base' => get_option( 'category_base' ),
        'page_on_front' => null,
        'page_for_posts' => null,
        'permalink_structure' => get_option( 'permalink_structure' ),
        'show_on_front' => get_option( 'show_on_front' ),
        'tag_base' => get_option( 'tag_base' ),
        'url' => get_bloginfo( 'url' )
    );

    if ( $routing['show_on_front'] === 'page' ) {
        $front_page_id = get_option( 'page_on_front' );
        $posts_page_id = get_option( 'page_for_posts' );

        if ( $front_page_id ) {
            $front_page = get_post( $front_page_id );
            $routing['page_on_front'] = $front_page->post_name;
        }

        if ( $posts_page_id ) {
            $posts_page = get_post( $posts_page_id );
            $routing['page_for_posts'] = $posts_page->post_name;
        }

    }

    return $routing;
}


/**
 * Navigations settings
 */
function vue_wordpress_menus() {
    $menus = array();
    // $locations is an array where ([NAME] = MENU_ID);
    $locations = get_nav_menu_locations();

    foreach ( array_keys( $locations ) as $name ) {
        $id = $locations[$name];
        $menu = array();
        $menu_items = wp_get_nav_menu_items( $id );

        foreach ( $menu_items as $i ) {

            array_push( $menu, array(
                'id'      => $i->ID,
                'parent'  => $i->menu_item_parent,
                'target'  => $i->target,
                'content' => $i->title,
                'title'   => $i->attr_title,
                'url'     => $i->url,
            ) );

        }

        $menus[$name] = $menu;
    }

    return $menus;
}


/**
 * Стартовая коллекция данных
 */
function vue_wordpress_site() {
    return Array(
        'description' => get_bloginfo( 'description' ),
        'docTitle' => '',
        'loading' => false,
        'logo' => get_theme_mod( 'custom_logo' ),
        'name' => get_bloginfo( 'name' ),
        'posts_per_page' => get_option( 'posts_per_page' ),
        'url' => get_bloginfo( 'url' ),
        'template_url' => get_bloginfo( 'template_url' ),
        'isAdmin' => in_array( 'administrator', wp_get_current_user()->roles ),    
        'primary-color' => get_theme_mod('primary-color', '#FF0000'),
        'blocks' => Array(
            'header' => Array(
                'title' => get_theme_mod('block_header_title'),
                'desc'  => get_theme_mod('block_header_desc'),
                'cover' => get_theme_mod('block_header_cover'),
            ),
            'footer' => Array(
                'title' => get_theme_mod('block_footer_title'),
                'desc'  => get_theme_mod('block_footer_desc'),
                'copyright' => get_theme_mod('block_footer_copyright'),
            ),
        ),

    );
}