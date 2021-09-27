<?php
      /*
      * Auxiliary function
      * argument: $media = object as provided by ACF component
      * return: html output for each media type and $media options
      */
      function render_media($media) {
        $output = "";
        $output .= $media['content_type'] == 'image'     ? render_image( $media['image'] ) : "";
        $output .= $media['content_type'] == 'video'     ? render_video($media['video'], $media['poster']) : "";
        $output .= $media['content_type'] == 'animation' ? render_lottie($media['animation']) : "";
        $output .= $media['content_type'] == '3d'        ? render_3d($media['three_d'], $media['poster3d']) : "";
        $output .= $media['content_type'] == 'embeded'   ? render_embeded($media['embeded']) : "";
        return $output;
      }

      /*
      * Auxiliary function
      * argument: $btn = object as provided by ACF component 
      * return: html output for button, witth icon and label
      */
      function render_button( $btn ) {
          if ( $btn['button_options'] ) {
            $class = $btn['button_options']['button_layout'].' '.$btn['button_options']['button_size'].' m-1';
            $label = $btn['button_options']['link']['title'];
            $url   = $btn['button_options']['link']['url'];
            $icon  = $btn['button_options']['button_icon'];
            
            return "<a class='$class' role='button' href='$url'>$icon $label</a>";
          }
      };

      /*
      * Auxiliary function
      * argument: $buttons_group = object as provided by ACF component, as a array of buttons 
      * return: html output thats render the complete group of buttons
      */
      function render_buttons_group ($buttons) {

        $buttons = $buttons['button_set'];
        $flex_direction = $buttons['stacked'] ? "d-flex flex-column" : "d-flex flex-row";
        $output = "";
        if ($buttons) {
            $output = "<div class='{$flex_direction} buttons-group' >";
                foreach($buttons as $btn) {
                    $output .= render_button($btn);
                };
            $output .= "</div>";
        }
        return $output;
      };

      /*
      * Auxiliary function, render a div with textual elements and buttons
      * arguments: 
      *     $title = the title  
      *     $subtitle = the subtitle 
      *     $text = plain text
      *     $class = especific class to apply to whole div, defaults to bootstrap col
      *     $group = an array that renders a group of buttons, defaults to no buttons
      * return: html output thats render the complete group of buttons
      */
      function render_text_content( $title, $subtitle, $text, $class="col-sm-12 col-md-6", $buttons=[]) {
          return "<div class=' $class '>".
                  ($title ? "<h1>$title</h1>" : "").
                  ($subtitle ? "<h2>$subtitle</h2>" : "").
                  ($text ? "<p>$text</p>" : "").
                  render_buttons_group($buttons).
          "</div>";
      };

      /*
      * Auxiliary function, render a div with textual elements and buttons
      * arguments: 
      */
      function render_info( $text, $buttons ) {
          return render_text_field($text).render_buttons_group($buttons);
      };

      function render_fill($fill) {
        $type = $fill['fill_type'];
        $color      = $fill['color'] ? $fill['color'] : 'transparent' ;
        $gColorFrom = $fill['start_color'];
        $gColorTo   = $fill['end_color'];
        $gAngle     = $fill['direction'];
        $patImage   = $fill['image']['sizes']['full'];
        $patPos     = $fill['pattern_position'];
        $patSize    = $fill['pattern_size'].'%';

        if ($type == 'color')    { return "background-color: $color ;"; }
        if ($type == 'gradient') { return "background: linear-gradient($gAngle, $gColorFrom, $gColorTo); "; }
        if ($type == 'pattern')  { return "background: url($patImage) repeat $patSize;"; }
        
        if ($type == 'colorpattern') { 
          if ($patPos == 'over')  { return "background: url($patImage) repeat $patSize $color; "; }
          if ($patPos == 'under') { return "background: $color url($patImage) repeat $patSize; "; }
        }

        if ($type == 'gradientpattern') { 
          if ($patPos == 'over')  { return "background: url($patImage) repeat $patSize linear-gradient($gAngle, $gColorFrom, $gColorTo); "; }
          if ($patPos == 'under') { return "background: linear-gradient($gAngle, $gColorFrom, $gColorTo) url($patImage) repeat $patSize; "; }
        }

        return "background: none;";
      }

      function render_text_field($text, $buttons = []) { 
        $_buttons = $buttons ? render_buttons_group($buttons) : "";
        return "
          <div class='text_content p-{$text['padding']} p-sm-0' style='--color: {$text['text_color']}' tint='{$text['text_custom_color']}';'>
            <div class='title {$text['title_selector']}' >
              {$text['title']}
            </div>
            <div class='subtitle {$text['subtitle_selector']}'>
              {$text['subtitle']}
            </div>
            <div class='text {$text['text_selector']}'>
              {$text['text']}
            </div>
              $_buttons
          </div>
        ";
      }

      function render_image($imgArr) {
          if ($imgArr) {
              $thumbnail    = $imgArr['sizes']['thumbnail'];
              $medium       = $imgArr['sizes']['medium'];
              $medium_large = $imgArr['sizes']['medium_large'];
              $large        = $imgArr['sizes']['large'];
              $title        = $imgArr['alt'] ? $imgArr['alt'] : 'visual content';
              return "<picture>
                <source srcset='$medium' media='(min-width: 768px)'>
                <source srcset='$medium_large' media='(min-width: 1000px)'>
                <source srcset='$large' media='(min-width: 1920px)'>
                <img src='$thumbnail' alt='$title' style='object-fit: cover; width: 100%; height: 100%'>
              </picture>";
          }
      }
      
      function render_card_image($imgArr) {
          if ($imgArr) {
              $thumbnail    = $imgArr['sizes']['thumbnail'];
              $medium       = $imgArr['sizes']['medium'];
              $medium_large = $imgArr['sizes']['medium_large'];
              $large        = $imgArr['sizes']['large'];
              $title        = $imgArr['alt'] ? $imgArr['alt'] : 'visual content';
              return "<picture>
                <source srcset='$medium' media='(min-width: 768px)'>
                <source srcset='$medium_large' media='(min-width: 1000px)'>
                <source srcset='$large' media='(min-width: 1920px)'>
                <img src='$thumbnail' alt='$title' class='card-img-top'>
              </picture>";
          }
      }

      function render_video( $video, $poster ) {
        global $inlinestyles;
        $videoposter = $poster['sizes']['medium_large'];
        if (!$GLOBALS[$inlinestyles['video']]) {
          $inlinestyles['video'] = true;
          echo "<style>
            .video-container { 
              width: 100%;
              height: 100%;
            }
            .video-container video {
              width: 100%;
              height: 100%;
              object-fit: cover;
            }
          </style>";
        }

          return "
          
          <div class='video-container'>
            <video autoplay='true' controls='false' muted='true' loop='true'>
                <source src='$video'/>
            </video>
          </div>
          
          ";
      }

      function render_lottie( $lottieFile, $options='autoplay loop', $background='transparent'){
        global $inlinestyles;
        if (!$inlinestyles['lottie']) {
          $inlinestyles['lottie'] = true;
          echo "
          <style>
            .lottie-animation {
              width: 100%;
              background: $background;
            }
          </style>
          ";
        }        
        return "
        <lottie-player $options mode='normal' src='$lottieFile' class='lottie-animation'></lottie-player> 
        ";
      }

      function render_3d( $file, $poster3d, $options="" ){
        return "
            <model-viewer src='$file' poster='$poster3d' ar ar-modes='webxr scene-viewer quick-look' camera-controls auto-rotate shadow-intensity='1' style='width: 100%; height: 100%;'>
              <div class='progress-bar hide' slot='progress-bar'>
                  <div class='update-bar'></div>
              </div>
              <button slot='ar-button' id='ar-button'>
                  View in your space
              </button>
              <div id='ar-prompt'>                 
              </div>
          </model-viewer>
        ";
      }
      
      function render_embeded( $embed ){
        global $inlinestyles;
        if (!$inlinestyles['embeded']) {
          $inlinestyles['embeded'] = true;
          echo "<style>
          iframe {
            width: 100%;
            height: 100%;
            z-index: -1;
          }
         </style>";
        }
        return "
          $embed
        ";
      }

      function render_cta_field($options, $text, $media, $buttons){
        $overshow  = $options['overlay']['show'] == 'true' ? 'block' : 'none';
        $overcolor = $options['overlay']['color'];
        $overopac  = $options['overlay']['opacity'];
        $center    = $options['center_center'];
        $column    = $text['column'];
        $padX      = $options['padding_horizontal'].'vw';
        $padY      = $options['padding_vertical'].'vh';

        $fill      = render_fill($options['fill_options']);
        $padding   = "padding: $padY $padX; ";
        $height    = "height: {$options['height']}; ";
        $style     = $fill.$padding.$height;

        if ($options['content_position'] == "background") {
         $output = "
          <section class='call-to-action' style='$style'>
            <div class='container-".$options['width']." content-position-background' style=''>
              <div class='row m-0 p-0 g-0'>
                <div class='background-content' >".render_media($media)."</div>
                <div class='overlay' style='--overshow: $overshow; --overopac: $overopac; --overcolor: $overcolor'></div>
                <div class='info col-sm-11 col-md-9 col-lg-8 col-xl-6' center='$center' >".render_text_field($text, $buttons)."</div>
              </div>
            </div>
          </section>";
          return $output;
        }

        if ($options['content_position'] == "left") {
          $output = "
          <section class='call-to-action' style='$style'>
             <div class='container-".$options['width']." h-100 content-position-left'>
                <div class='row justify-content-center align-content-center h-100'>
                    <div class='col d-flex flex-grow-1' >".render_media($media)."</div>
                    <div class='$column' >".render_text_field($text, $buttons)."</div>
                </div>
                <div class='overlay' style='--overshow: $overshow; --overopac: $overopac; --overcolor: $overcolor'></div>
             </div>
           </section>";
           return $output;
         }

         if ($options['content_position'] == "right") {
          $output = "
          <section class='call-to-action' style='$style'>
             <div class='container-".$options['width']." h-100 content-position-left'>
                  <div class='row justify-content-center align-content-center h-100'>
                    <div class='$column'>".render_media($media)."</div>
                    <div class='col d-flex flex-grow-1' >".render_text_field($text, $buttons)."</div>
                  </div>
                  <div class='overlay' style='--overshow: $overshow; --overopac: $overopac; --overcolor: $overcolor'></div>
               </div>
           </section>";
           return $output;
         }

         if ($options['content_position'] == "left-border") {
          $output = "
          <section class='call-to-action' style='$style'>
             <div class='container-".$options['width']." h-100 content-position-background'>
                <div class='row'>
                   <div class='background-content-at-left-border' >".render_media($media)."</div>
                   <div class='info col-sm-11 col-md-9 col-lg-8 col-xl-6' center='$center' >".render_text_field($text, $buttons)."</div>
                </div>
                <div class='overlay' style='--overshow: $overshow; --overopac: $overopac; --overcolor: $overcolor'></div>
               </div>
           </section>";
           return $output;
         }

         if ($options['content_position'] == "right-border") {
          $output = "
          <section class='call-to-action' style='$style'>
             <div class='container-".$options['width']." h-100 content-position-background'>
                    <div class='background-content-at-right-border'>".render_media($media)."</div>
                    <div class='info' center='$center' >".render_text_field($text, $buttons)."</div>
              </div>
              <div class='overlay' style='--overshow: $overshow; --overopac: $overopac; --overcolor: $overcolor'></div>
           </section>";
           return $output;
         }

    }

    function render_card($card) {
      $image = $card['image'];
      $text = $card['text'];
      $button = $card['button'];

      return "
        <div class='col'>
        <div class='card h-100'>
          ".render_card_image($image)."
          <div class='card-body'>
            <h5 class='card-title'>{$text['title']}</h5>
            <p class='card-text'>{$text['text']}</p>
          </div>
          <div class='card-footer'>
            <a class='btn btn-card' href='".$button['link']['url']."'>{$button['link']['label']}</a>
          </div>
        </div>
      </div>
      ";
    }

    function render_cards_from_collection($collection) {
      $output = "";
      foreach($collection as $card) {
        $output .= render_card($card);
      }
      return $output;
    }

    function render_2cols_collection( $collection, $featured_content ) {
      return "
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-sm-12 col-lg-6'>
               ".render_card($featured_content)."
            </div>
            <div class='col-sm-12 col-lg-6'>
                <div class='row row-cols-1 row-cols-md-2 g-4'>
                  ".render_cards_from_collection($collection)."       
                </div>
            </div>  
          </div>
        </div>
      ";
    }

      function filterPanel() {
        return "<div class='filter-panel></div>";
      }

      function overlayPanel() {
        return "<div class='filter-panel></div>";
      }

      function cardsColletion() {
        return "<div class='filter-panel></div>";
      }
  
