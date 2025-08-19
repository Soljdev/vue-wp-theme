<?php
/*
 * functions_customizer.php
 * Добавляем настройки темы в раздел внешний вид
 */
add_action( 'customize_register', 'true_customizer_init' );
function true_customizer_init( $wp_customize ) {
    $transport = 'refresh';

    // Пример удаления стандартной панели(Настройки главной страницы) из настроек
    add_action('customize_register', function($wp_customize) {
        $wp_customize->remove_section('static_front_page');
    }, 20);

    //  Добавляем настройку в раздел "Свойства сайта"
    if( $section = 'title_tagline' ) {
        // Блок разделения настроек
        $separator = 'section_1';
        $wp_customize->add_setting($section . '_' . $separator, array()); // dummy
        $wp_customize->add_control( new Sub_Section_Heading_Custom_Control( 
            $wp_customize, $section . '_' . $separator,
            array(
                'label'   => __( 'Дополнительные опции', $section . '_' . $separator ),
                'section' => $section,
            )
        ) );

        // colorpicker
        $wp_customize->add_setting( 'primary-color',
            array(
                'default' => '#000000', // значение по умолчанию
                'sanitize_callback' => 'sanitize_hex_color' // обязательно для цветов
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'primary-color',
                array(
                    'label'    => __('Выберите цвет', 'your-textdomain'),
                    'section'  => $section,
                    'settings' => 'primary-color'
                )
            )
        );
        //
    }

    // Создаем новую панель
    $panel = 'blocks_panel';
    $wp_customize->add_panel( $panel,
        array(
            'priority'       => 90,
            'title'          => 'Редактировать блоки',
            'description'    => 'Тут вы можете настроить внешний вид своего сайта.',
        )
    );

    //  Настройки главной страниыцы
    if( $section = 'front_page' ) {
        
        // Добавляем подсекцию (третий уровень)
        $subsection = 'blocks_header';
        $wp_customize->add_section($subsection, array(
            'title'       => __('Редактировать шапку', $subsection . '_title'),
            'panel'       => $panel, // Привязываем к панели
            'priority'    => 20,
        ));

        // block_header_title
            $setting = 'block_header_title';
            $wp_customize->add_setting( $setting,
                array(
                    'priority'       => 10,
                    'default'    =>  "", // для чекбокса значения по умолчанию true/false
                    'transport'  =>  $transport,
                )
            );
            $wp_customize->add_control( $setting,
                array(
                    'section'   => $subsection,
                    'label'     => 'Заголовок',
                    'type'      => 'text',
                    'description' => ''
                )
            );
            if ( isset( $wp_customize->selective_refresh ) ){
                $wp_customize->selective_refresh->add_partial( $setting, [
                    'selector'            => '*[data-t-'.$setting.']',
                    'container_inclusive' => false,
                    // 'render_callback'     => 'footer__phone_dh5theme',
                    'fallback_refresh'    => false, // Prevents refresh loop when document does not contain .cta-wrap selector. This should be fixed in WP 4.7.
                ] );
            }
        //

        // block_header_desc
            $setting = 'block_header_desc';
            $wp_customize->add_setting( $setting,
                array(
                    'priority'       => 10,
                    'default'    =>  "", // для чекбокса значения по умолчанию true/false
                    'transport'  =>  $transport,
                )
            );
            $wp_customize->add_control( $setting,
                array(
                    'section'   => $subsection,
                    'label'     => 'Текст',
                    'type'      => 'textarea',
                    'description' => ''
                )
            );
            if ( isset( $wp_customize->selective_refresh ) ){
                $wp_customize->selective_refresh->add_partial( $setting, [
                    'selector'            => '*[data-t-'.$setting.']',
                    'container_inclusive' => false,
                    // 'render_callback'     => 'footer__phone_dh5theme',
                    'fallback_refresh'    => false, // Prevents refresh loop when document does not contain .cta-wrap selector. This should be fixed in WP 4.7.
                ] );
            }
        //

        // block_header_cover
            $setting = 'block_header_cover';
            $wp_customize->add_setting( $setting,
                array(
                    'priority'       => 1,
                    'transport'  =>  $transport,
                )
            );
            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    $setting.'_control',
                    array(
                        'label'    => 'Изображене для шапки',
                        'settings' => $setting,
                        'section'  => $subsection,
                        'description' => ''
                    )
                )
            );
        //


        // Добавляем подсекцию (третий уровень)
        $subsection = 'blocks_footer';
        $wp_customize->add_section($subsection, array(
            'title'       => __('Редактировать подвал', $subsection . '_title'),
            'panel'       => $panel, // Оставляем привязку к той же панели
            // 'section'  => $section,     // Привязываем к родительской секции
            'priority'    => 20,
        ));

        // block_footer_title
            $setting = 'block_footer_title';
            $wp_customize->add_setting( $setting,
                array(
                    'priority'       => 10,
                    'default'    =>  "", // для чекбокса значения по умолчанию true/false
                    'transport'  =>  $transport,
                )
            );
            $wp_customize->add_control( $setting,
                array(
                    'section'   => $subsection,
                    'label'     => 'Заголовок',
                    'type'      => 'text',
                    'description' => ''
                )
            );
            if ( isset( $wp_customize->selective_refresh ) ){
                $wp_customize->selective_refresh->add_partial( $setting, [
                    'selector'            => '*[data-t-'.$setting.']',
                    'container_inclusive' => false,
                    // 'render_callback'     => 'footer__phone_dh5theme',
                    'fallback_refresh'    => false, // Prevents refresh loop when document does not contain .cta-wrap selector. This should be fixed in WP 4.7.
                ] );
            }
        //

        // block_footer_desc
            $setting = 'block_footer_desc';
            $wp_customize->add_setting( $setting,
                array(
                    'priority'       => 10,
                    'default'    =>  "", // для чекбокса значения по умолчанию true/false
                    'transport'  =>  $transport,
                )
            );
            $wp_customize->add_control( $setting,
                array(
                    'section'   => $subsection,
                    'label'     => 'Текст',
                    'type'      => 'textarea',
                    'description' => ''
                )
            );
            if ( isset( $wp_customize->selective_refresh ) ){
                $wp_customize->selective_refresh->add_partial( $setting, [
                    'selector'            => '*[data-t-'.$setting.']',
                    'container_inclusive' => false,
                    // 'render_callback'     => 'footer__phone_dh5theme',
                    'fallback_refresh'    => false, // Prevents refresh loop when document does not contain .cta-wrap selector. This should be fixed in WP 4.7.
                ] );
            }
        //

        // block_footer_copyright
            $setting = 'block_footer_copyright';
            $wp_customize->add_setting( $setting,
                array(
                    'priority'       => 10,
                    'default'    =>  "", // для чекбокса значения по умолчанию true/false
                    'transport'  =>  $transport,
                )
            );
            $wp_customize->add_control( $setting,
                array(
                    'section'   => $subsection,
                    'label'     => 'Копирайт',
                    'type'      => 'textarea',
                    'description' => ''
                )
            );
            if ( isset( $wp_customize->selective_refresh ) ){
                $wp_customize->selective_refresh->add_partial( $setting, [
                    'selector'            => '*[data-t-'.$setting.']',
                    'container_inclusive' => false,
                    // 'render_callback'     => 'footer__phone_dh5theme',
                    'fallback_refresh'    => false, // Prevents refresh loop when document does not contain .cta-wrap selector. This should be fixed in WP 4.7.
                ] );
            }
        //
    }

}


if( class_exists( 'WP_Customize_Control' ) ) {

    class Sub_Section_Heading_Custom_Control extends WP_Customize_Control {
        //The type of control being rendered
        public $type = 'sub_section_heading';

        //Render the control in the customizer
        public function render_content() {
            if( !empty( $this->label ) ) { 
                ?>
                <div class="sub-section-heading-control" style='text-align:center; padding: 8px; background-color: #ccc'>
                    <h3 class="customize-control-title" style='margin:0;'><?php echo esc_html( $this->label ); ?></h3>
                </div>
                <?php
            }
        }
    }

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
