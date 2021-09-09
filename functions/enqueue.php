<?php

//** -- Remove -- ** //

// Update jQuery
add_action('wp_enqueue_scripts', 'theme_remove_default_jquery');
function theme_remove_default_jquery() {
	wp_deregister_script('jquery');
    wp_register_script( 'jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js", array(), '3.6.0', false );
    wp_enqueue_script('jquery');
}

// Remove Scripts
add_action('wp_footer', 'theme_remove_scripts');
function theme_remove_scripts(){
	wp_dequeue_script('wp-embed');
}

// Remove CSS
add_action('wp_print_styles', 'theme_remove_styles', 100);
function theme_remove_styles() {
    wp_dequeue_style('wp-block-library');
}

//** -- Generate random version -- ** //

// Get theme version
function wpmix_get_version() {
	$theme_data = wp_get_theme();
	return $theme_data->Version;
}

$theme_version = wpmix_get_version();
global $theme_version;

// Get random number
function wpmix_get_random() {
	$randomizr = '-' . rand(100,999);
	return $randomizr;
}

$random_number = wpmix_get_random();
global $random_number;

//** -- Generate random version -- ** //

// Style
add_action('wp_enqueue_scripts', 'theme_enqueue_css');

function theme_enqueue_css() {
    global $wp_styles;
    global $theme_version, $random_number;
    wp_enqueue_style( "bootratrap",    "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
    wp_enqueue_script( "bootstrap_js", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js", null, false, false );
    wp_enqueue_style('main-css', get_stylesheet_directory_uri().'/assets/style/style.css', false, $theme_version.$random_number);
}

// Scripts ACTUALLY Rellax and Flickity
add_action('wp_enqueue_scripts', 'theme_enqueue_js', 90);

function theme_enqueue_js() {
    global $wp_query;
    global $acf;

    $scripts_url = get_stylesheet_directory_uri()."/assets/scripts/";

    // Script Header
    wp_register_script('script-header', $scripts_url."script-header.js", null, null, false);
    wp_enqueue_script('script-header');
    
    // Script Footer
    wp_register_script('script-footer', $scripts_url."script-footer.js", null, null, true);
    wp_enqueue_script('script-footer');
    
    // Font Awesome
    wp_register_script('font-awesome', 'https://kit.fontawesome.com/f6e2c5467d.js', null, null, true);
    wp_enqueue_script('font-awesome');

    //lottie
    wp_register_script( 'lottie', "https://unpkg.com/@lottiefiles/lottie-player@0.4.0/dist/tgs-player.js", null, null, true );
    wp_enqueue_script( 'lottie');

    //3d
    wp_register_script( 'model_viewer', "https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js", null, null, true );
    wp_enqueue_script( 'model_viewer');
}

add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
function add_type_attribute($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ( 'model_viewer' !== $handle ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}
?>