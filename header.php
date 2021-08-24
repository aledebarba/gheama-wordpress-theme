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
    <!-- /theme -->
	
    <?php
        the_field('site_script_header', 'option');
        wp_head();
    ?>
</head>

<body>
	<div id="site">
        <!-- header -->
		<header class="header inverse" id="header">
			<!-- logo -->
			<figure class="logo" role="presentation">
				<a href="<?php echo get_home_url(); ?>">
					<?php get_template_part('templates/element_logo_lettering'); ?>
				</a>
			</figure>
			<!-- /logo -->
			
            <!-- main menu -->
            <?php wp_nav_menu(array(
                'theme_location' => 'main_menu_header',
                'container_id' => false,
                'container' => 'nav',
                'container_class' => 'menu-main',
                'items_wrap' => '
                    <ul>
                        %3$s
                    </ul>
                ',
                'depth' => '2',
                'walker' => new theme_custom_menu_header()
            )); ?> 
            <!-- /main menu -->
			
            <?php if(have_rows('buttons_header_button', 'option')) : ?>
            <!-- buttons -->
            <nav class="menu-buttons">
                <ul>
                    <?php while(have_rows('buttons_header_button', 'option')) : the_row();
                    
                        $button = get_sub_field('link'); if($button) :
                            $url = $button['url'];
                            $title = $button['title'];
                            $target = $button['target'] ? $button['target'] : '_self';
                        endif;

                        $button_class = get_sub_field('class');
                        $button_size = get_sub_field('size');
                        $button_icon = get_sub_field('icon');						
                    ?>
                    <li>
                        <a href="<?php echo esc_url($url); ?>" class="button round <?php echo $button_size; echo ' '; echo $button_class; ?>" target="<?php echo esc_attr($target); ?>">
                            <span><?php echo esc_html($title); ?></span>
                            <?php if($button_icon) : echo '<span>'; echo $button_icon; echo '</span>'; endif; ?>   
                        </a>
                    </li>
                    <?php endwhile; ?>
                    </ul>
            </nav>
            <!-- /buttons -->
            <?php endif; ?>
			
			<!-- call menu mobile -->
			<div class="hamburger display-mobile">
				<a class="call-menu">
					<i class="fal fa-bars"></i>
                    <i class="fal fa-times"></i>
				</a>
			</div>
			<!-- /call menu mobile -->
		</header>
		<!-- /header -->
        
        <main class="content" id="content">