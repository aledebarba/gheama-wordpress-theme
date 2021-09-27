<?php
   $disclaimer = get_field('footer_disclaimer', 'option');
   $showSocial = get_field('show_social_networks_icons','option');
   $socialInfo = get_field('site_social_media','option');
   $footerMenu = get_field('footer_menu','option');
   $footerImage = get_field('footer_image','option');
   $footerTextColor = get_field('footer_text_custom_color','option') ? "--footer-elemenst-color: ".get_field('footer_text_custom_color','option').";" : "";
   $footerBackgroundColor = get_field('footer_background_custom_color', 'option') ? "--footer-background-custom-color: ".get_field('footer_text_custom_color','option').";" : "";
?>


    <footer id='footer pt-5' style='<?php echo $footerTextColor.$footerBackgroundColor ?>'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-4">
                <?php
                      if ($showSocial) {
                          echo '<div class="footer-social-menu d-flex">';
                          foreach ($socialInfo as $info) {
                              $href = $info['link']['url'];
                              $target = $info['link']['target'];
                              $title = $info['link']['title'];
                              $icon = $info['icon'];
                              echo "<a href='$href' target='$target' title='$title'>$icon</a>";
                          }
                          echo '</div>';
                      }
                ?>
                </div>
                <div class="col-sm-12 col-md-8 footer-menu">
                    <div class="footer-menu justify-content-center d-flex">
                        <?php echo render_nav($footerMenu); ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <img src='<?php echo $footerImage['sizes']['thumbnail'] ;?>' alt="" class='footer-image'>
            </div>
        </div>
    </div>
</footer>
</main>
<?php wp_footer(); ?>
</body>
</html>