<section class='widget-slideshow'>
<?php

      $options = get_sub_field('slideshow_options');
      $showPageDots = $options['slideshow_show_page_dots'] ? 'true' : 'false';

if (have_rows('slides')) {
      $slides_config = '
            {
              "cellAlign": "center", 
              "contain": "true",
              "wrapAround": "true",
              "autoPlay": '.$options['slideshow_autoplay_time'].',
              "pageDots": '.$showPageDots.'
             }';

      echo "<div class='widget-slideshow' data-flickity=' $slides_config '>";
      while( have_rows('slides') ) {
            the_row();
            $options    = get_sub_field('options');
            $text       = get_sub_field('text_content');
            $media      = get_sub_field('media');
            $buttons    = get_sub_field('buttons_group');

            echo render_cta_field($options, $text['text_content'], $media, $buttons);
      }
      echo "</div>";
}
?>
</section>