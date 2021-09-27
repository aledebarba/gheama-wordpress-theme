<?php
      $pt = get_sub_field('padding_top')."rem";
      $pb = get_sub_field('padding_bottom')."rem";
      $ph = get_sub_field('padding_horizontal')."rem";
      $pad = "padding: $pt $ph $pb $ph;";
      $bgc = "background-color: ".get_sub_field('background_color').';';
      $rowcols = "row-cols-".get_sub_field('columns_per_row');      

$output = "
<section class='widget-columns'style='$pad $bgc'>
    <div class='container-fluid' >
        <div class='row $rowcols'>";
        if (have_rows('columns')) {
            while(have_rows('columns')) {
                the_row();
                $contentType = get_sub_field('column_content');
                $output .= "<div class='col'>";
                $output .= $contentType == 'text' ? render_text_field( get_sub_field('text_content')) : "";
                $output .= $contentType == 'media' ? render_media( get_sub_field('media') ) : "";
                $output .= $contentType == 'editor' ? "<div class='txt'>".get_sub_field('editor_content')."</div>" : "";
                $output .= $contentType == 'empty' ? "<div class='empty-column'></div>" : "";
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