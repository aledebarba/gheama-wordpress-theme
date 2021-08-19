<?php
include('functions/remove.php');
include('functions/enqueue.php');
include('functions/post.php');
include('functions/menu.php');
include('functions/acf.php');
include('functions/custom_panel.php');

//** -- SVG -- ** //

add_filter('upload_mimes', 'theme_files_format_upload');

function theme_files_format_upload($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    
    $file_types = array_merge($file_types, $new_filetypes );
    
    return $file_types;
}

//** -- SVG -- ** //

//** -- Contact Form 7 -- **//
/*
if(class_exists('WPCF7')) {
	function theme_enqueue_wpcf7_scripts() {
		
		// Pages to add CF7 scripts
		$pages_cf7_add_scripts = array('contact', 'emergency-callout');
		
		if(is_page( $pages_cf7_add_scripts ) || is_single($single_cf7_add_scripts)) {
			if(function_exists( 'wpcf7_enqueue_scripts')) {
				wpcf7_enqueue_scripts();
			}
			
			if(function_exists('wpcf7_enqueue_styles')) {
				//wpcf7_enqueue_styles();
			}
		}
	
	}
	
	add_filter('wpcf7_load_js', '__return_false'); // javascript
	add_filter('wpcf7_load_css', '__return_false'); // css
	add_action('wp_enqueue_scripts', 'theme_enqueue_wpcf7_scripts');
}
*/
//** -- Contact Form 7 -- **//

//** -- Yoast SEO -- **//

add_filter('wpseo_metabox_prio', 'theme_yoast_meta_box');
function theme_yoast_meta_box() {
	return 'low'; // Move Yoast Meta Box to bottom
}

//** -- Yoast SEO -- **//

?>