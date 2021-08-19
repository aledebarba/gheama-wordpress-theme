<?php
    $privacy = get_sub_field('privacy');
	$content = get_sub_field('content');
?>
<div class="box-form">
    <?php
        if($content) : 
        foreach($content as $p) : // variable must NOT be called $post (IMPORTANT) 
            $cf7_id= $p->ID;
            echo do_shortcode('[contact-form-7 id="'.$cf7_id.'" ]');
        endforeach;
        endif;
    ?>

    <?php if(get_sub_field('privacy')) : ?>
        <div class="privacy">
            <?php echo $privacy; ?>
        </div>
    <?php endif; ?>
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