<?php
    $options = get_sub_field( "options" );
    $text    = get_sub_field( "text_content" );
    $media   = get_sub_field( "media" );
    $buttons = get_sub_field( "buttons_group" );
    
    echo render_cta_field($options, $text, $media, $buttons);   
?>