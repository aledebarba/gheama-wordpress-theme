<?php
      // TODO test if options doesn't exist
      $parallax = get_sub_field('header_parallax');      
      $top_logo = get_sub_field('top_logo');
      $logo = get_sub_field('logo');
      $background = get_sub_field('background_type') == "image" ? render_image( get_sub_field('image')) 
                  : (get_sub_field('background_type') == "video" ? render_video( get_sub_field('video'), get_sub_field('video_poster') ) : "<span></span>");
      
      console($background);

      $output = "
      <section class='hero_header' id='hero-header'>
            <div  class='container-fluid p-0 m-0'>
                  <div class='background' id='header-layer-background' style='position: absolute;'>$background</div>
                  <div class='top-center-logo' id='header-top-center-logo'>"
                       .($top_logo ? "<img src='{$top_logo['sizes']['medium']}' alt='company brand illustration' />" : "") . "
                  </div>
                  <div class='centered-logo' id='header-centered-logo' data-depth='0.50'>"
                        .($logo ? "<img src='{$logo['sizes']['medium']}' alt='company brand illustration' />" : "") . "
                  </div>
                  <div class='down-button'></div>
            </div>
      </section>
      ";
      console($output);
      echo $output;

      if ($parallax) { ?>
          <script>
            const registerHeaderScroller = true;
            function CreateHeaderParallax() {
                        console.log('here')
                 const headerLogoRef = document.querySelector("#header-centered-logo img")
                 const headerBg = document.querySelector("#header-layer-background")
                  
                  gsap.to(headerBg, {
                        scrollTrigger: {
                              trigger: headerBg,
                              start: 'top top',
                              end: 'bottom end',
                              scrub: true
                        },
                        ease: 'none',
                        y: '85vh'
                  })

                  gsap.to(headerLogoRef, {
                        scrollTrigger: {
                              scrub: true,
                              trigger: headerBg,
                              start: 'top top',
                              end: 'bottom end'
                        },
                        ease: 'none',
                        y: 0
                  })
           
            };
            </script>
<?php
      } // endif;
?>