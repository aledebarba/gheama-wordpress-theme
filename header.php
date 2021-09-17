<!doctype html>
<html lang="en">
<head>
    <title><?php wp_title(); ?></title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- theme -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/assets/icons/favicon-16x16.png">
    <link rel="manifest" href="<?php bloginfo('template_directory'); ?>/assets/icons/site.webmanifest">
    <link rel="mask-icon" href="<?php bloginfo('template_directory'); ?>/assets/icons/safari-pinned-tab.svg" color="#50235c">
    
    <meta name="apple-mobile-web-app-title" content="Sabi&aacute;">
    <meta name="application-name" content="Sabi&aacute;">
    
    <meta name="msapplication-TileColor" content="#50235c">
    <meta name="theme-color" content="#50235c">
    <?php wp_head(); ?>

</head>

<body>
    <main class="content"'>
    <?php 
        $option = get_field('header_appearance', 'option');
        $brand =  $option['header_menu_image']['sizes']['medium'];
        $menu = $option['header_menu'];
        echo nav_slide_down($menu, true, ['Reservations', 'https://google.com', '_blank', 'secondary'],$brand);
    ?>