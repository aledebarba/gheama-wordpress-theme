<?php
    if(have_rows('intro')) :
    while(have_rows('intro')) :
    the_row();

    $headline_01 = get_sub_field('headline_01');
    $headline_02 = get_sub_field('headline_02');
    $headline_03 = get_sub_field('headline_03');

    $content_type = get_sub_field('content_type');
    $content_position = get_sub_field('content_position');

    $image = get_sub_field('image');
    $image_mobile = get_sub_field('image_mobile');

    if($image) :
        $size = 'large';
        $thumb = $image['sizes'][$size];
    endif;

    if($image_mobile) :
        $size_mobile = 'large';
        $thumb_mobile = $image_mobile['sizes'][$size_mobile];
    endif;

    $video = get_sub_field('video');
    $poster = get_sub_field('poster');
?>

<div class="item<?php if( (($content_type) == "image") || (($content_type) == "video")  ) : echo ' '; echo $content_position; endif;?>">
    <!-- text -->
    <div class="box-text">
        <?php
            if(get_sub_field('headline_01')) :
                echo '<h1 class="h1">';
                echo $headline_01;
                echo '</h1>';
            endif;

            if(get_sub_field('headline_02')) :
                echo '<h4 class="h6">';
                echo $headline_02;
                echo '</h4>';
            endif;

            if(get_sub_field('headline_03')) :
                echo '<p>';
                echo $headline_03;
                echo '</p>';
            endif;
        ?>

        <?php get_template_part('templates/element_buttons'); ?>
    </div>
    <!-- /text -->
    <?php
        if(($content_type) == "image") :
    ?>
        <figure class="box-image" role="presentation">
            <img src="<?php echo esc_url($thumb_mobile); ?>" alt="" class="display-mobile" class="no-lazy">
            <img src="<?php echo esc_url($thumb); ?>" alt="" class="display-desktop" class="no-lazy">
        </figure>
    <?php
        endif;
        if(($content_type) == "video") :
    ?>
        <figure class="box-video" role="presentation">
            <video autoplay muted loop poster="<?php echo $poster;?>">
                <source src="<?php echo $video; ?>" type="video/mp4">
            </video>
        </figure>
    <?php endif; ?>
</div>

<?php
    endwhile;
    endif;
?>