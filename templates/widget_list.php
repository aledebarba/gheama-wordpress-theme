<?php
    $list_format = get_sub_field('list_format');
    $card_format = get_sub_field('card_format');
    $field = get_sub_field_object('list_format');

    get_template_part('templates/element_headline');
?>
    <div class="hold-list <?php echo $list_format; ?>" id="hold-list">
        <?php
            if(have_rows('content')) :
            while(have_rows('content')) : the_row();

            $image = get_sub_field('image');
            $icon = get_sub_field('icon');
            if (!$icon) {
                $icon = "";
            }           

            $link = get_sub_field('link');

            if($image) :
                $image_size = 'medium';
                $image_thumb = $image['sizes'][$image_size];
            endif;
           
            if($link) :
                $url = $link['url'];
                $title = $link['title'];
                $target = $link['target'] ? $link['target'] : '_self';
            endif;
        
            $headline_01 = get_sub_field('headline_01');
            $headline_02 = get_sub_field('headline_02');
            $headline_03 = get_sub_field('headline_03');
            $text_content = get_sub_field('content');
            $show_icon  = (get_sub_field('optional_element') == 'show_icon');
            $show_image = (get_sub_field('optional_element') == 'show_image');

        ?>
            <?php if($list_format == 'accordion') : ?>
               <!-- item -->
                <div class="item-accordion">
                    <div class="title-accordion">
                        <?php echo $headline_01; ?>
                    </div>
                    <div class="panel-accordion">
                        <div class="box-accordion">
                            <div class="card">
                                <?php
                                    if($headline_02) :
                                        echo '<h6 class="h6">';
                                        echo $headline_02;
                                        echo '</h6>';
                                    endif;

                                    if($headline_03) :
                                        echo '<p>';
                                        echo $headline_03;
                                        echo '</p>';
                                    endif;
                                    
                                    // render image or icon and text content
                                    if ($show_image and $image) echo "<img src='$image_thumb' alt='item list illustration'/>";
                                    if ($show_icon and $icon) echo "<span>$icon</span>";
                                    echo $text_content;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
        
            <!-- /item -->
                
            <?php else : ?>
                <div class="card <?php echo esc_attr($card_format['direction']); echo ' '; echo esc_attr($card_format['size']); echo ' '; echo esc_attr($card_format['style']); echo ' '; echo esc_attr($card_format['image']); echo ' '; echo esc_attr($card_format['icon']); ?>">
                    <div class="hold-card">
                        <?php
                            if(get_sub_field('extra_element') == 'show_image') : 
                        ?>
                            <div class="box-image" role="presentation">
                                <figure class="hold-image">
                                    <?php if(get_sub_field('link')) : ?>
                                        <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                    <?php endif; ?>
                                        <img src="<?php echo esc_url($thumb); ?>">
                                    <?php if(get_sub_field('link')) : ?>
                                        </a>
                                    <?php endif; ?>
                                </figure>
                            </div>
                        <?php
                            endif;
                            if(get_sub_field('extra_element') == 'show_icon') :
                        ?>
                            <div class="box-icon" role="presentation">
                                <div class="hold-icon">
                                    <?php if(get_sub_field('link')) : ?>
                                        <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                                    <?php endif; ?>
                                        <?php echo $icon; ?>
                                    <?php if(get_sub_field('link')) : ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php
                            endif;
                        ?>
                        <div class="box-text">
                            <?php
                                if($headline_01) :
                                    echo '<h5 class="h4">';
                                    echo $headline_01;
                                    echo '</h5>';
                                endif;

                                if($headline_02) :
                                    echo '<h6 class="h6">';
                                    echo $headline_02;
                                    echo '</h6>';
                                endif;

                                if($headline_03) :
                                    echo '<p>';
                                    echo $headline_03;
                                    echo '</p>';
                                endif;
                                
                                // render image or icon and text content
                                if ($show_image and $image) echo "<img src='$image_thumb' alt='item list illustration'/>";
                                if ($show_icon and $icon) echo $icon;
                                echo $text_content;

                            ?>
                        </div>
                        
                    </div>
                </div>
            <?php endif; ?>
        <?php
            endwhile;
            endif;
        ?>
    </div>
<?php get_template_part('templates/element_buttons'); ?>