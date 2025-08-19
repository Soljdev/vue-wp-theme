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