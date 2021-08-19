<?php
    $display_01 = get_field('display');
    $style_01 = get_field('style');
    $extra_styles_01 = get_field('extra_styles');
    $field_01 = get_field_object('style');
?>
<section class="widget-slide <?php echo $display_01; echo ' '; echo $style_01; echo ' ';  echo implode(' ', $extra_styles_01); echo ' widget-'.$field_01['ID'].''; echo get_row_index(); ?>" id="widget-slide-header">
    <div class="hold">
        <div class="slide-hold" id="slideshow-<?php echo $field_01['ID']; echo get_row_index();?>">
            <?php get_template_part('templates/widget_slide'); ?>
        </div>
    </div>

    <script>
        ;(function(slide) {
            var gallery = slide.getElementById('slideshow-<?php echo $field_01['ID']; echo get_row_index();?>');
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
</section>
    
<?php
    // widget class name
    function theme_widget_class_name() {
        if (get_row_layout() == 'article') : echo 'widget-article'; endif;
        if (get_row_layout() == 'list') : echo 'widget-list'; endif;
        if (get_row_layout() == 'content_feed') : echo 'widget-feed'; endif;
        if (get_row_layout() == 'gallery') : echo 'widget-gallery'; endif;
        if (get_row_layout() == 'shortcode') : echo 'widget-shortcode'; endif;
        if (get_row_layout() == 'form') : echo 'widget-form'; endif;
    };

    if(have_rows('content_widgets')) :
    while (have_rows('content_widgets')) : the_row();

    // template
    if(get_row_layout() == 'template') :
        $template = get_sub_field('template_item');
        if($template) :
        foreach($template as $post) : setup_postdata($post);
            //if(have_rows('content_widgets')) :
            while (have_rows('content_widgets')) : the_row(); 
                get_template_part('templates/template_widgets');
            endwhile;
            //endif;
        endforeach;
        wp_reset_postdata();
        endif;

    // slideshow

    elseif(get_row_layout() == 'slideshows') :
        $display_02 = get_sub_field('display');
        $style_02 = get_sub_field('style');
        $extra_styles_02 = get_sub_field('extra_styles');
        $field_02 = get_sub_field_object('style');
    ?>    
        <section class="widget-slide <?php echo $display_02; echo ' '; echo $style_02; echo ' ';  echo implode(' ', $extra_styles_02); echo ' widget-'.$field_02['ID'].''; echo get_row_index(); ?>">
            <div class="hold">
                <div class="slide-hold" id="slideshow-<?php echo $field_02['ID']; echo get_row_index();?>">
                    <?php get_template_part('templates/widget_slide'); ?>
                </div>
            </div>
            
            <script>
                ;(function(slide) {
                    var gallery = slide.getElementById('slideshow-<?php echo $field_02['ID']; echo get_row_index();?>');
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
        </section>
        
    <?php
        else :
        get_template_part('templates/template_widgets');
    endif;

    endwhile;
    endif;
?>