<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<!-- <body style="--primary-color: <?=get_theme_mod('primary-color', '#FF0000');?>"> -->
<body>
    <div id="vue-wordpress-app">
        <? 
        set_query_var( 'vw_nav_menu', 'main' );
        get_template_part('components/top-panel'); 
        ?>