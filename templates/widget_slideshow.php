<?php
     
      $compOptions = get_field( "slideshow_options" );
      $slides_config = '
            {
              "cellAlign": "center", 
              "contain": true,
              "wrapAround": "true",
              "autoPlay": 3000,
              "pageDots": false
             }';

      echo "<div class='main-carousel' data-flickity=' $slides_config '>";
      if ( have_rows('slides') ) {
             while( have_rows('slides') ) {
                  the_row();
                  $slideOptions = get_sub_field('slide_options');
                  $bg           = $slideOptions['buttons_group']; 
                  $richmedia    = $slideOptions['media']['content_type'] == "image" ? render_image($slideOptions['media']['image']) : render_video($slideOptions['media']['video'], $slideOptions['media']['poster']); 
                  $layout       = $slideOptions['content_position'];
                  $textcolor    = $slideOptions['text_color'];
                  $media        = get_sub_field('media');
                  $textcontent  = render_text_content($slideOptions['title'], $slideOptions['subtitle'], $slideOptions['text'], $slideOptions['column'], $bg);

                  echo "<div class='carousel-cell'>".render_CallToAction( $textcontent, $richmedia, $layout, 'auto', $textcolor )."</div>";
             }
      }      
      echo "</div>
      <style>
            .carousel-cell {
                  width: 100%;
            }
            .carousel-cell img {
                  object-fit: cover;
                  height: 100%;
                  width: 100%;
            }
            .flickity-prev-next-button svg {
                  filter: brightness(10);
                  transform: scale(1.3);
            }
      </style>
      ";
?>
