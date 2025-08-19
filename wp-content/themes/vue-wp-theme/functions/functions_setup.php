<?php
/**
 * functions_setup.php
 * Настраиваем тему
 */
function vue_wordpress_setup()
{
    add_theme_support( 'responsive-embeds' ); // добавляем поддержку адаптивных встраиваемых медиа (embeds) в тему.
    add_theme_support( 'align-wide' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails', array( 'post', 'demo' ) ); // Активируем миниатюры записей для post и demo типов записей
    add_theme_support( 'custom-logo', array( // Кастомные параметры логотипа
        // 'height' => 160,
        // 'width' => 160,
    ) );
    register_nav_menus( array( // Регестрируем область навигации
        'main' => 'Main Menu',
        'footerNav' => 'Footer Menu',
    ) );
    add_theme_support( 'editor-styles' ); // Активируем поддержку стилей редактора
    add_editor_style( 'editor-style.css' ); // Подключаем файл стилей
}




/*
 * Добавляем Кастомный тип записи
 * Альтернативный вариант nocode: 
 * Используйте плагин Advanced Custom Fields (ACF®)
 * https://ru.wordpress.org/plugins/advanced-custom-fields/
 */
// Функция для регистрации кастомного типа записи
function create_demo_post_type() {
    register_post_type('demo', array(
        'labels' => array(
            'name' => 'Демо-записи',                  // Название во множественном числе
            'singular_name' => 'Демо-запись',         // Название в единственном числе
            'add_new' => 'Добавить новую демо-запись',
            'add_new_item' => 'Добавить новую демо-запись',
            'edit_item' => 'Редактировать демо-запись',
            'new_item' => 'Новая демо-запись',
            'view_item' => 'Просмотреть демо-запись',
            'search_items' => 'Искать демо-записи',
            'not_found' => 'Демо-записи не найдены',
            'not_found_in_trash' => 'В корзине демо-записи не найдены',
            'parent_item_colon' => 'Родительская демо-запись:'
        ),
        'public' => true,                             // Публичный тип записи
        'publicly_queryable' => true,                 // Доступен для запросов
        'show_ui' => true,                            // Показывать в админке
        'show_in_menu' => true,                       // Показывать в меню админки
        'query_var' => true,                          // Использовать в запросах
        'rewrite' => array('slug' => 'demo'),         // Слаг для URL
        'capability_type' => 'post',                  // Права доступа как у постов
        'has_archive' => true,                        // Создать архив
        'hierarchical' => false,                      // Не иерархический тип
        'menu_position' => 5,                         // Позиция в меню
        'supports' => array(                          // Поддерживаемые функции
            'title',                                  // Заголовок
            'editor',                                 // Редактор
            'excerpt',                                // Краткое содержание
            'thumbnail',                              // Миниатюра
            'custom-fields',                          // Пользовательские поля
            //'comments',                             // Комментарии
            'revisions',                              // Версии
            'trackbacks'                              // Отслеживание
        ),
        'taxonomies' => array('category', 'post_tag') // Таксономии
    ));
}

// Хук для регистрации типа записи
add_action('init', 'create_demo_post_type');

/*
 * Добавляем Демо-данные в тип 'demo'
 */
function vue_wp_theme_insert_demo_data() {
    // Проверяем, были ли уже добавлены демо-данные
    if (get_option('vue_wp_theme_demo_data_installed')) {
        return;
    }

    // Пример добавления 3 демо-записей
    for ($i = 1; $i <= 3; $i++) {
        wp_insert_post(array(
            'post_title'   => "Демо запись $i",
            'post_content' => "Это содержимое демо записи $i.",
            'post_status'  => 'publish',
            'post_type'    => 'demo',
        ));
    }

    // Отмечаем, что демо-данные установлены
    update_option('vue_wp_theme_demo_data_installed', 1);
};
add_action('after_switch_theme', 'vue_wp_theme_insert_demo_data');