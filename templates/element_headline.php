<?php
$headline_01 = get_sub_field('headline_01');
$headline_02 = get_sub_field('headline_02');
$headline_03 = get_sub_field('headline_03');

if(get_sub_field('headline_01') || get_sub_field('headline_02') || get_sub_field('headline_03')) : ?>
<div class="box-headline">
    <?php
        if(get_sub_field('headline_01')) :
            echo '<h2 class="h1">';
            echo $headline_01;
            echo '</h2>';
        endif;
    
        if(get_sub_field('headline_02')) :
            echo '<h3 class="h3">';
            echo $headline_02;
            echo '</h3>';
        endif;
    
        if(get_sub_field('headline_03')) :
            echo '<h6 class="h6">';
            echo $headline_03;
            echo '</h6>';
        endif;
    ?>
</div>
<?php endif; ?>