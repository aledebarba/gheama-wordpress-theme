<?php
    // ************* Insert the widget file 
    $widget_name = get_row_layout();

     // if name has the "widget_" prefix, removes it. All PHP files are marked as widget_
    $widget_name = str_replace("widget_","",$widget_name);
    
    if ($widget_name) {
        get_template_part('templates/widget_'.$widget_name); 
    }
?>