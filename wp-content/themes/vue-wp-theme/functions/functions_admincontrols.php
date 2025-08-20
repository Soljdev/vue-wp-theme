<?php
/*
functions_admincontrols.php
В этом файле модифицируем параметры админ панели
*/


/*
 * Скрываем лишние разделы и пункты меню
 */
function remove_admin_menu() {
    // 	remove_menu_page('options-general.php');    // Удаляем раздел Настройки
    //  remove_menu_page('edit.php');               // Записи
    //  remove_menu_page('tools.php');              // Инструменты
    //  remove_menu_page('users.php');              // Пользователи
    //  remove_menu_page('plugins.php');            // Плагины
    // 	remove_menu_page('themes.php');             // Внешний вид
    // 	remove_menu_page('edit.php');               // Посты блога
    // 	remove_menu_page('upload.php');             // Медиабиблиотека
    // 	remove_menu_page('edit.php?post_type=page');// Страницы
    remove_menu_page('edit-comments.php');      // Комментарии
    //  remove_menu_page('link-manager.php');       // Ссылки
}
add_action('admin_menu', 'remove_admin_menu');
 
function remove_menus()
{
    // remove_submenu_page("edit.php", "edit-tags.php?taxonomy=post_tag");  // «Записи» - «Метки»
    // remove_submenu_page("themes.php", "theme-editor.php");               // «Внешний вид» - «Редактор тем»
    // remove_submenu_page("themes.php", "site-editor.php?path=/patterns"); // «Внешний вид» - «Редактор тем»
    remove_submenu_page("options-general.php", "options-discussion.php");   // «Настройки» - «Обсуждения»
    remove_submenu_page('options-general.php', "options-writing.php");   // options-writing.php
}
add_action("admin_menu", "remove_menus", 99999);


/*
 * Скрываем лишние типы записей из виджета "На виду"
 */
function remove_default_glance_items( $items ) {
    $items_to_remove = array(
        // 'posts',
        // 'media',
        // 'pages',
        'comments'
    );

    foreach ( $items_to_remove as $key => $value ) {
        if ( isset( $items[ $key ] ) ) {
            unset( $items[ $key ] );
        }
    }

    return $items;
}
add_filter( 'dashboard_glance_items', 'remove_default_glance_items', 10, 1 );


/*
 * Добавляем свои типы записей в виджет "На виду"
 */
function custom_glance_items( $items = array() ) {
    $post_types = array( 'demo' ); // типы записей
    
    foreach( $post_types as $type ) {
        if(! post_type_exists( $type ) ) continue;
        
        $num_posts = wp_count_posts( $type );
        if( $num_posts ) {
            $published = intval( $num_posts->publish );
            $post_type = get_post_type_object( $type );
            
            $text = _n( '%s '. $post_type->labels->singular_name, '%s '. $post_type->labels->name, $published, 'your_textdomain' );
            $text = sprintf( $text, number_format_i18n( $published ) );
            
            if ( current_user_can( $post_type->cap->edit_posts ) ) {
                $items[] = sprintf( '<a class="%1$s-count" href="edit.php?post_type=%1$s">%2$s</a>', $type, $text ). "\n";
            } else {
                $items[] = sprintf( '<span class="%1$s-count">%2$s</span>', $type, $text ). "\n";
            }
        }
    }
    
    return $items;
}
add_filter( 'dashboard_glance_items', 'custom_glance_items', 10, 1 );


/*
 * Правим стили боковой панели в админке
 */
function custom_admin_styles() {
    echo '<style>
        #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
            width: 220px !important;
        }
		#wpcontent, #wpfooter {
    		margin-left: 220px !important;
		}
		#adminmenu .wp-submenu { left: 220px }
    </style>';
}
add_action('admin_head', 'custom_admin_styles');


/*
 * Добавляем записи из кастомных типов записей в виджет "Активность"
 */
add_filter( 'dashboard_recent_posts_query_args', function ( $query_args ) {
    // Получаем массив всех публичных типов записей, которые имеют права доступа типа "post"
    $post_types = get_post_types( array( 'public' => true, "capability_type" => "post" ) );
    // Проверяем, является ли текущий тип записи массивом
    if ( is_array( $query_args['post_type'] ) ) {
        // Если да, заменяем его на наш массив типов записей
        $query_args['post_type'] = $post_types;
    } else {
        // Если нет, создаем временную переменную и присваиваем ей наш массив
        $temp = $post_types;
        $query_args['post_type'] = $temp;
    }
    // Возвращаем модифицированные аргументы запроса
    return $query_args;
});