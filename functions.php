<?php
include('functions/remove.php');
include('functions/enqueue.php');
include('functions/post.php');
include('functions/menu.php');
include('functions/acf.php');
include('functions/custom_panel.php');
include('functions/render-components.php');
include('functions/render-navs.php');
include('functions/utils.php');

//** -- SVG -- ** //
define( 'ALLOW_UNFILTERED_UPLOADS', true );
add_filter('upload_mimes', 'theme_files_format_upload');
function theme_files_format_upload($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $new_filetypes['obj'] = 'application/wavefront-obj';
    $new_filetypes['gltf'] = 'model/gltf-binary';
    $new_filetypes['glb'] = 'model/gltf-binary';
    $new_filetypes['pdf'] = 'application/pdf';
    $new_filetypes['json'] = 'application/json';

    $file_types = array_merge($file_types, $new_filetypes );
    
    return $file_types;
}

add_filter('wpseo_metabox_prio', 'theme_yoast_meta_box');
function theme_yoast_meta_box() {
	return 'low'; // Move Yoast Meta Box to bottom
}

?>