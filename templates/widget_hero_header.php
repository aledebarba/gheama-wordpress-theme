<?php
      $logo = get_sub_field('logo');
      $background = get_sub_field('background_type') == "image" ? render_image( get_sub_field('image') ) : "<span></span>";

      echo "
      <section class='hero_header'>
            <div  class='container-fluid p-0 m-0'>
                  <div class='background'>$background</div>
                  <div class='overlay'></div>
                  <div class='centered-logo'><img src=".$logo['sizes']['medium']." alt='brand illustration'/></div>
                  <div class='up-title'></div>
                  <div class='down-button'></div>
            </div>
      </section>
      ";
?>