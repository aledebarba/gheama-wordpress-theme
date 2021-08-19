		</main>

        <!-- footer -->
		<footer class="footer">
            <div class="hold">
                <!-- hold menu -->
                <div class="hold-menu">
                    <!-- logo -->
                    <figure class="logo" role="presentation">
                        <a href="<?php echo get_home_url(); ?>">
                            <?php get_template_part('templates/element_logo'); ?>
                        </a>
                    </figure>
                    <!-- /logo -->
                    
                    <!-- buttons -->
                    <nav class="menu-buttons">
                        <?php if(have_rows('buttons_footer_button', 'option')) : ?>
                        <ul>
                            <?php while(have_rows('buttons_footer_button', 'option')) : the_row();
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
                        <?php endif; ?>
                    </nav>
                    <!-- /buttons -->

                    <?php
                        $location = 'menu_footer_item_02'; 

                        wp_nav_menu(array(
                            'theme_location' => $location,
                            'container_id' => false,
                            'container' => 'nav',
                            'container_class' => 'menu-main',
                            'items_wrap' => '
                                <ul>
                                    %3$s
                                </ul>
                            ',
                            'depth' => '1',
                            'walker' => new theme_custom_menu_footer()
                        ));
                    ?>

                    <nav class="menu-social">
                        <ul>
                        <?php
                            if(have_rows('site_social_media', 'option')) :
                            while(have_rows('site_social_media', 'option')) :
                            the_row();
                            
                            $icon = get_sub_field('icon');
                            $link = get_sub_field('link');
                            
                            if($link) :
                                $url = $link['url'];
                                $title = $link['title'];
                                $target = $link['target'] ? $link['target'] : '_blank';
                            endif;
                        ?>
                            <li>
                                <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                    <?php echo $icon; ?> <?php echo esc_html($title); ?>
                                </a>
                            </li>
                        <?php
                            endwhile;
                            endif;
                        ?>
                    </ul>
                    </nav>
                </div>
                <!-- /hold menu -->

                <!-- hold footer -->
                <div class="hold-footer">
                    <?php
                        if(get_field('footer_disclaimer', 'option')) :
                            echo '<div class="disclaimer">';
                            the_field('footer_disclaimer', 'option');
                            echo '</div>';
                        endif;
                    ?>

                    <nav class="institutional-menu">
                        <ul role="presentation">
                            <li class="copy">&copy;<?php echo date("Y");?></li>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'menu_footer_institutional',
                                'container_id' => false,
                                'container' => '',
                                'container_class' => '',
                                'items_wrap' => '%3$s',
                                'depth' => '1',
                                'walker' => new theme_custom_menu_institutional()
                            )); ?>
                            <li class="created"><a href="https://dncandg.com/" target="_blank">Created by DNC_G</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- /hold footer -->
            </div>
		</footer>
		<!-- /footer -->
	</div>

	<?php
        the_field('site_script_footer', 'option');
        wp_footer();
    ?>
</body>
</html>