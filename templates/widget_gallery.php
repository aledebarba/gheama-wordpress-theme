<?php
    get_template_part('templates/element_headline');

    $feed_format = get_sub_field('feed_format');
    $field = get_sub_field_object('feed_format');
?>
    <div class="gallery-hold <?php echo $feed_format; ?>" id="widget-<?php echo $field['ID']; echo get_row_index();?>">
        <?php
            // mosaic
            if(get_sub_field('feed_format') == 'mosaic') : { ?>
                <?php
                    $images = get_sub_field('content');
                    if($images) :

                    foreach($images as $image) :

                    $link_extra = get_field('link_extra', $image['ID']);
                    if($link_extra) :
                        $url = $link_extra['url'];
                        $title = $link_extra['title'];
                        $target = $link_extra['target'] ? $link_extra['target'] : '_self';
                    endif;
                { ?>
                    <figure class="item">
                        <?php if(get_field('link_extra', $image['ID'])) : ?>
                            <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">     
                        <?php else : ?>
                            <a href="<?php echo esc_url($image['sizes']['large']); ?>">
                        <?php endif; ?>
                            <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        </a>
                    </figure>
                <?php }
                    endforeach;
                    wp_reset_postdata();
                    endif;
                ?>
            <?php }
            // carousel
            elseif(get_sub_field('feed_format') == 'carousel') : { ?>
                <?php
                    $images = get_sub_field('content');
                    if($images) :
                        
                    foreach($images as $image) :

                    $link_extra = get_field('link_extra', $image['ID']);
                    if($link_extra) :
                        $url = $link_extra['url'];
                        $title = $link_extra['title'];
                        $target = $link_extra['target'] ? $link_extra['target'] : '_self';
                    endif;
                { ?>
                    <figure class="item">
                        <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        
                        <?php if($image['caption']) : ?>
                            <figcaption>
                                <?php echo esc_attr($image['caption']); ?>
                            </figcaption>
                        <?php endif; ?>
                    </figure>
                <?php }
                    endforeach;
                    wp_reset_postdata();
                    endif;
                ?>
                        
                <script>
                    ;(function(slide) {
                        var gallery = slide.getElementById('widget-<?php echo $field['ID']; echo get_row_index();?>');
                        var count = gallery.getElementsByClassName('item').length;

                        if (count > 1) {
                            var flkty = new Flickity(gallery, {
                                wrapAround: true,
                                cellAlign: 'left',
                                draggable: true,

                                prevNextButtons: true,
                                pageDots: false,

                                autoPlay: 7000,
                                pauseAutoPlayOnHover: true,

                                arrowShape:  'M30.6,77.8l1.6-1.6c1-1,1-2.7,0-3.8L13.4,53.8h83.9c1.5,0,2.7-1.2,2.7-2.7v-2.2c0-1.5-1.2-2.7-2.7-2.7H13.4l18.7-18.6c1-1,1-2.7,0-3.8l-1.6-1.6c-1-1-2.7-1-3.8,0l-26,25.9c-1,1-1,2.7,0,3.8l26,25.9C27.8,78.8,29.5,78.8,30.6,77.8z'
                            });
                        }
                    })(document);
                </script>
            <?php } endif;
        ?>
    </div>
<?php get_template_part('templates/element_buttons'); ?>