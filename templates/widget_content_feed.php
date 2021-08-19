<?php
    get_template_part('templates/element_headline');

    $feed_format = get_sub_field('feed_format');
    $field = get_sub_field_object('feed_format');

    $post_type = get_sub_field('post_type');
    $number_posts = get_sub_field('number_posts');
?>
    <div class="feed-hold <?php echo $feed_format; ?>" id="widget-<?php echo $field['ID']; echo get_row_index();?>">
        <?php
            query_posts (array(
                'post_type' => $post_type,
                'posts_per_page' => $number_posts,
            ));
            while (have_posts()) : the_post();
                // carousel
                if(get_sub_field('feed_format') == 'carousel') :
                    get_template_part('templates/card_carousel');
                // compact
                elseif(get_sub_field('feed_format') == 'compact') :
                    get_template_part('templates/card_compact');
                // full
                elseif(get_sub_field('feed_format') == 'full') :
                    get_template_part('templates/card_full');
                endif;
            endwhile;
            wp_reset_query();
        ?>
        
        <?php if(get_sub_field('feed_format') == 'carousel') : ?>
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
        <?php endif; ?>
    </div>
<?php get_template_part('templates/element_buttons'); ?>