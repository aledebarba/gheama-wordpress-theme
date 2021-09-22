<?php
      // TODO test if options doesn't exist
      $parallax = get_sub_field('header_parallax');      
      $top_logo = get_sub_field('top_logo');
      $logo = get_sub_field('logo');
      $background = get_sub_field('background_type') == "image" ? render_image( get_sub_field('image') ) : "<span></span>";

      echo "
      <section class='hero_header' id='hero-header'>
            <div  class='container-fluid p-0 m-0'>
                  <div class='background' id='header-layer-background'>$background</div>
                  <div class='overlay'></div>
                  <div class='top-center-logo' id='header-top-center-logo'><img src=".$top_logo['sizes']['medium']." alt='brand at top illustration'/></div>
                  <div class='centered-logo' id='header-centered-logo' data-depth='0.50'><img src=".$logo['sizes']['medium']." alt='brand illustration'/></div>
                  <div class='down-button'></div>
            </div>
            <div id='hero-header-overlay'></div>
      </section>
      ";
      if ($parallax) { ?>
          <script>
            document.addEventListener("DOMContentLoaded", function() {

                  const headerLogoRef = document.querySelector("#header-centered-logo img")
                 gsap.to(headerLogoRef, {
                       scrollTrigger: {
                              trigger: headerLogoRef,
                              start: 'top center',
                              end: 'bottom top',
                              scrub: 1                             
                       },
                       opacity: 0,
                       y: "-100%",
                       ease: Power2.easeIn 
                 })
                 gsap.to('#header-top-center-logo', {
                        scrollTrigger: {
                              trigger: "#header-top-center-logo",
                              start: 'top 12px',
                              end: 'top -75%',
                              pin: true,
                              scrub: 1
                        },
                        ease: Power2.easeIn 
                  });                 

                 gsap.to('#hero-header-overlay', {
                        scrollTrigger: {
                              trigger: '#hero-header',
                              start: 'top top',
                              end: 'bottom top',
                              scrub: 1
                        },
                        y: -200,
                        ease: Power2.easeIn 
                  });

            });
            </script>
<?php
      } // endif;
?>