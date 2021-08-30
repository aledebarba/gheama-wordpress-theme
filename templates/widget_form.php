<?php
    $privacy = get_sub_field('privacy');
	$content = get_sub_field('content');
    $form_id = "[contact-form-7 id='$content->ID']";
?>

<div class="box-form">
    <?php
          echo do_shortcode($form_id);
          if ($privacy) {
              echo "
                <div class='privacy'>
                    $privacy
                </div>
              ";
          }
    ?>

</div>

<aside class="box-side">
<?php
    if(get_sub_field('sidebar') == 'yes') :
        get_template_part('templates/element_contact_bar');
    else :
        get_template_part('templates/element_headline');
    endif;
?>
</aside>