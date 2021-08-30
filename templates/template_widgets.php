<?php
    $display = get_sub_field('display');
    $style = get_sub_field('style');
    $extra_styles = get_sub_field('extra_styles');

    $custom_id = get_sub_field('custom_id');
    $field = get_sub_field_object('custom_id');
?>
    <section class="<?php theme_widget_class_name(); echo ' '; echo $display; echo ' '; echo $style; if($extra_styles) : echo ' '; echo implode(' ', $extra_styles); endif; if(get_sub_field('custom_background') == 'image' || get_sub_field('custom_background') == 'video') : echo ' custom-background'; endif; echo ' widget-'.$field['ID'].''; echo get_row_index(); ?>" <?php if($custom_id) : echo ' id="'.$custom_id.'"'; endif; ?>>
        <div class="hold<?php if($extra_styles) : echo implode(' ', $extra_styles); endif;
                    if(get_row_layout() == 'article') :
                    $element_position = get_sub_field('element_position');
                    $image_styles = get_sub_field('image_styles');

                    if(get_sub_field('extra_element') == 'show_image') :
                        if($element_position) : echo ' '; echo $element_position; endif;
                        if($image_styles) : echo ' '; echo implode(' ', $image_styles); endif;
                    elseif(get_sub_field('extra_element') == 'show_video_embed') :
                        if($element_position) : echo ' '; echo $element_position; endif;
                    else :
                        echo ' no-element';
                    endif;
                endif;
            ?>">
            <?php // article
            if(get_row_layout() == 'article') : 
                get_template_part('templates/widget_article');
            endif; ?>

            <?php // list
            if(get_row_layout() == 'list') :
                get_template_part('templates/widget_list');
            endif; ?>

            <?php // posts list
            if(get_row_layout() == 'content_feed') :
                get_template_part('templates/widget_content_feed');
            endif; ?>

            <?php // gallery
            if(get_row_layout() == 'gallery') :
                get_template_part('templates/widget_gallery');
            endif; ?>
            
            <?php // shortcode
            if(get_row_layout() == 'shortcode') : 
                get_template_part('templates/widget_shortcode');
            endif; ?>

            <?php // form
            if(get_row_layout() == 'form') :
                get_template_part('templates/widget_form');
            endif; ?>
            
            <?php
                $custom_background = get_sub_field('custom_background');
            
                $background_image = get_sub_field('background_image');
                $background_image_mobile = get_sub_field('background_image_mobile');
                $background_image_position = get_sub_field('background_image_position');

                if($background_image) :
                    $size = 'large';
                    $thumb = $background_image['sizes'][$size];
                endif;

                if($background_image_mobile) :
                    $size_mobile = 'large';
                    $thumb_mobile = $background_image_mobile['sizes'][$size_mobile];
                endif;
            
                $background_video = get_sub_field('background_video');
                $background_poster = get_sub_field('background_poster');
            
                if(($custom_background) == "image") :
            ?>
            <figure class="custom-background <?php echo $background_image_position; ?>" role="presentation">
                <img src="<?php echo esc_url($thumb_mobile); ?>" alt="" class="display-mobile" class="no-lazy">
                <img src="<?php echo esc_url($thumb); ?>" alt="" class="display-desktop" class="no-lazy">
            </figure>
            <?php
                endif;
                if(($custom_background) == "video") :
            ?>
            <figure class="custom-background" role="presentation">
                <video muted loop autoplay poster="<?php echo $background_poster;?>">
                    <source src="<?php echo $background_video; ?>" type="video/mp4">
                </video>
            </figure>
            <?php endif; ?>
        </div>
    </section>