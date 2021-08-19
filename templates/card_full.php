<div class="item card-full">
	<div class="box-hold">
		<div class="box-image">
            <figure role="presentation">
                <a href="<?php the_permalink() ?>">
                    <?php
                        if (has_post_thumbnail()) { ?>
                            <img src="<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id($page->ID), 'thumbnail', false, ''); echo $src[0]; ?>" alt="<?php the_title(); ?>">
                        <?php }

                        else {
                            echo '<img src="'.get_bloginfo('stylesheet_directory').'/assets/images/placeholder-logo.png" alt="">';
                        }
                    ?>
                </a> 
            </figure>
		</div>

		<div class="box-text">
            <h2 class="h3"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        
            <?php if (get_post_type(get_the_ID()) == 'post') : ?>
                <?php _e('<i class="fal fa-folder-open"></i> '); the_category(', '); ?>
                <time datetime="<?php the_time('Y-m-d'); ?>"><i class="fal fa-clock"></i> <?php the_time('F jS, Y'); ?></time>
            <?php endif; ?>
            
            <?php the_excerpt(); ?>
		</div>
	</div>
</div>