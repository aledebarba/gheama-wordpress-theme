<?php
//** -- Advanced Custom Fields -- **//

// Option Pages
if (function_exists('acf_add_options_page')) {
	// Site Management
	acf_add_options_page (array(
		'page_title' => 'Site Management',
		'menu_title' => 'Site Management',
		'menu_slug' => 'site-management',
		'capability' => 'edit_posts',
		'redirect' => false,
		'icon_url' => 'dashicons-info',
		'position' => 2
	));
}

add_action('admin_enqueue_scripts', 'acf_custom_styles');
function acf_custom_styles () {
	wp_enqueue_style( 'acf_custom_scripts', get_stylesheet_directory_uri().'/assets/style/acf_custom.min.css', null, null, "screen" );
}

//add_filter('acf/settings/show_admin', '__return_false'); // Hide ACF from menu

/*
// Google Maps API 
add_filter('acf/fields/google_map/api', 'acf_google_map_api');
function acf_google_map_api($api){
    $api['key'] = 'AIzaSyD8-0qSNtnmdYfXFGF16LT2rSd_D8g__U8';
    return $api;
}
*/

//** -- Advanced Custom Fields -- **//
?>