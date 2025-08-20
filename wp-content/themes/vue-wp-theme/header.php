<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<!-- <body style="--primary-color: <?=get_theme_mod('primary-color', '#FF0000');?>"> -->
<body>
     <?php
    // Получаем параметр из URL
    $novue = filter_input(INPUT_GET, 'novue');    
    // Формируем атрибуты для div
    $vueAppId = ($novue === 'y') ? '' : ' id="vue-wordpress-app"';
    ?>
    <div<?php echo $vueAppId; ?>>
        <? 
        set_query_var( 'vw_nav_menu', 'main' );
        get_template_part('template-parts/top-panel'); 
        ?>