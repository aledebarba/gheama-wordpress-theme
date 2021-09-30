<?php
      
      $height = 'height: '.get_sub_field('height').';';
      $pt = get_sub_field('padding_top')."rem";
      $pb = get_sub_field('padding_bottom')."rem";
      $ph = get_sub_field('padding_horizontal')."rem";
      
      $pad = "padding: $pt $ph $pb $ph;";
      $bgc = "background-color: ".get_sub_field('background_color').';';
      
      $rowcols = "row-cols-".get_sub_field('columns_per_row');  

$output = "
<section class='widget-columns'style='overflow: hidden; display: flex; align-items: center; $pad $bgc $height'>
    <div class='container-fluid p-0 m-0' >
        <div class='row $rowcols' style='overflow: hidden;'>";
        if (have_rows('columns')) {
            while(have_rows('columns')) {
                the_row();

                $contentType =  get_sub_field('column_content');
                $colAlign =     get_sub_field('vertical_alignment');
                $colJust =      get_sub_field('horizontal_alignment');
                $colPad =       get_sub_field('space_around');
                $colColor =     get_sub_field('background_color');
                
                $output .= "<div class='col d-flex $colAlign $colJust p-$colPad' style='overflow: hidden; background-color: $colColor' >";
                if ($contentType != 'empty') {
                    $output .= $contentType == 'text' ? render_text_field( get_sub_field('text_content')) : "";
                    $output .= $isImage ? render_image($isImage, "auto", "auto", "none") : ($contentType == 'media' ? render_media( get_sub_field('media') ) : "");
                    $output .= $contentType == 'editor' ? "<div class='txt'>".get_sub_field('editor_content')."</div>" : "";
                } else {
                    $output .= $contentType == 'empty' ? "<div class='empty-column'></div>" : "";
                }
                $output .= "</div>";
            }
        }
$output .= "   
        </div>
    </div>
</section>
";

echo $output;

?>