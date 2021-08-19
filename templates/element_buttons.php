<?php if(get_sub_field('button')) : ?>
    <div class="button-hold">
        <?php
            if(have_rows('button')) :
            while(have_rows('button')) :
            the_row();

            $button = get_sub_field('link'); if($button) :
                $url = $button['url'];
                $title = $button['title'];
                $target = $button['target'] ? $button['target'] : '_self';
            endif;

            $button_class = get_sub_field('class');
            $button_size = get_sub_field('size');
            $button_icon = get_sub_field('icon');
        ?>
        <a href="<?php echo esc_url($url); ?>" class="button round <?php echo $button_size; echo ' '; echo $button_class; ?>" target="<?php echo esc_attr($target); ?>">
            <span><?php echo esc_html($title); ?></span>
            <?php if($button_icon) : echo '<span>'; echo $button_icon; echo '</span>'; endif; ?>   
        </a>
        <?php
            endwhile;
            endif;
        ?>
    </div>
<?php endif; ?>