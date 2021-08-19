<?php
	$content = get_sub_field('content');

	$image = get_sub_field('image');
	$icon = get_sub_field('icon');
	$embed = get_sub_field('embed');

    $link = get_sub_field('link');
    $element_caption = get_sub_field('element_caption');

	if($image) :
		$size = 'medium';
		$thumb = $image['sizes'][$size];
        $alt = $image['alt'];
	endif;

    if($link) :
        $url = $link['url'];
        $title = $link['title'];
        $target = $link['target'] ? $link['target'] : '_self';
    endif;
?>
<div class="box-text">
    <?php get_template_part('templates/element_headline'); ?>

    <?php if(get_sub_field('content')) :
        echo $content;
    endif; ?>

     <?php get_template_part('templates/element_buttons'); ?>
</div>

<?php if(get_sub_field('extra_element') == 'show_image') : ?>
<figure class="box-image">
    <div class="hold-image">
        <?php if (get_sub_field('link')) : ?>
            <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
        <?php endif; ?>
            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>">
        <?php if (get_sub_field('link')) : ?> 
            </a>
        <?php endif; ?>
    </div>
    
    <figcaption>
        <?php echo $element_caption; ?>
    </figcaption>
</figure>
<?php endif; ?>

<?php if(get_sub_field('extra_element') == 'show_icon') : ?>
<figure class="box-icon">
    <div class="hold-icon">
        <?php if (get_sub_field('link')) : ?>
            <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
        <?php endif; ?>
            <?php echo $icon; ?>
        <?php if (get_sub_field('link')) : ?> 
            </a>
        <?php endif; ?>
    </div>
    
    <figcaption>
        <?php echo $element_caption; ?>
    </figcaption>
</figure>
<?php endif; ?>

<?php if(get_sub_field('extra_element') == 'show_video_embed') : ?>
<figure class="box-embed">
    <div class="hold-embed">
        <?php echo $embed; ?>
    </div>
    
    <figcaption>
        <?php echo $element_caption; ?>
    </figcaption>
</figure>
<?php endif; ?>