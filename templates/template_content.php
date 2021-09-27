<?php
    $display_01 = get_field('display');
    $style_01 = get_field('style');
    $extra_styles_01 = get_field('extra_styles');
    $field_01 = get_field_object('style');

    
    if(have_rows('content_widgets')) {
        while (have_rows('content_widgets')) {
            the_row();
            $template = get_row_layout();
            $widgetName = str_replace("widget_","",$template);
            get_template_part('templates/widget_'.$widgetName);
        }
    }
?>
