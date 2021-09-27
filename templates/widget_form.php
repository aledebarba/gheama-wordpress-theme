<?php
    $privacy = get_sub_field('privacy');
	$content = get_sub_field('content');
    $form_id = "[contact-form-7 id='$content->ID']";
?>


<section class='form'>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="box-form">
            <?php
                echo do_shortcode($form_id);
            ?>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
        <aside class="box-side">
            <?php
                if(get_sub_field('sidebar') == 'yes') :
                    get_template_part('templates/element_contact_bar');
                else :
                    get_template_part('templates/element_headline');
                endif;
            ?>
            </aside>
        </div>
    </div>
    <div class="row">
        <?php
              if ($privacy) {
                echo "
                    <div class='privacy'>
                        $privacy
                    </div>
                ";
            };
        ?>
    </div>
</div>
</section>