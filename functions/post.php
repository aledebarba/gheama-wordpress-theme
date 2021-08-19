<?php
//** -- Posts -- **//

// Thumbnails
add_theme_support('post-thumbnails');

update_option('thumbnail_size_w', 600);
update_option('thumbnail_size_h', 600);
update_option('thumbnail_crop', 0);

update_option('medium_size_w', 1000);
update_option('medium_size_h', 1000);
update_option('medium_crop', 0);

update_option('large_size_w', 2000);
update_option('large_size_h', 2000);
update_option('large_crop', 0);

// Disable Posts and Pages
add_action('admin_menu', 'theme_remove_default_post_types');
function theme_remove_default_post_types() {
    //remove_menu_page('edit.php'); // Post
	//remove_menu_page('edit.php?post_type=page'); // Page
}

add_action('admin_bar_menu', 'theme_remove_default_post_types_menubar', 999);
function theme_remove_default_post_types_menubar($wp_admin_bar) {
    //$wp_admin_bar->remove_node('new-post'); // Post
	//$wp_admin_bar->remove_node('new-page'); // Page
}

add_action('wp_dashboard_setup', 'theme_remove_default_post_types_draftwidget', 999);
function theme_remove_default_post_types_draftwidget(){
    //remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}

// Disable Tags
add_action('init', 'theme_unregister_tags');
function theme_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}

// Excerpt
//remove_filter('the_excerpt', 'wpautop');
remove_filter('term_description', 'wpautop');

add_filter('excerpt_length', 'theme_custom_excerpt_length');
function theme_custom_excerpt_length($length) {
	return 35;
}

add_filter('excerpt_more', 'theme_custom_excerpt_more');
function theme_custom_excerpt_more($more) {
	return ' (...)';
}

add_post_type_support('page', 'excerpt'); // add excerpt to pages

// Change Post Default Name
// https://gist.github.com/ControlledChaos/d572a31bd267f5bd2aa1
add_action('admin_menu', 'theme_change_post_label'); // menu labels
function theme_change_post_label() {
    global $menu, $submenu;
    $menu[5][0] = 'Articles';
    $submenu['edit.php'][5][0] = 'Articles';
    $submenu['edit.php'][10][0] = 'New Article';
    //$submenu['edit.php'][16][0] = 'Tags';
    echo '';
}

add_action('init', 'theme_change_post_object_label'); // page labels
function theme_change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Articles';
    $labels->singular_name = 'Article';
    //$labels->add_new = '';
    //$labels->add_new_item = '';
    //$labels->edit_item = '';
    //$labels->new_item = '';
    //$labels->view_item = '';
    //$labels->search_items = '';
    //$labels->not_found = '';
    //$labels->not_found_in_trash = '';
}

add_action('admin_menu', 'theme_change_post_menu_icon'); // menu icon
function theme_change_post_menu_icon() {
	global $menu;
	foreach ($menu as $key => $val) {
		if (__('News') == $val[0]) {
				$menu[$key][6] = 'dashicons-welcome-write-blog';
		}
	}
}

add_action('admin_head', 'theme_change_post_dashboard_icons'); // dashboard icon
function theme_change_post_dashboard_icons() {
	$screen = get_current_screen();
	if ($screen->id != 'dashboard' ) {
		return;
	}
	$style = '<style>';
	$style .= '#dashboard_right_now .post-count a[href="edit.php?post_type=post"]::before, #dashboard_right_now .post-count span::before {
		content: "\f488" !important;
	}';
	$style .= '</style>';
	echo $style;
}

add_action('admin_footer', 'theme_change_post_at_glance'); // at a glance
function theme_change_post_at_glance () { ?>
	<script>
		jQuery(document).ready( function ($) {
			$('.post-count a[href="edit.php?post_type=post"]').text(function () {
				return $(this).text().replace('1 Post', '1 Article');
			});
			$('.post-count a[href="edit.php?post_type=post"]').text(function () {
				return $(this).text().replace('Posts', 'Articles' );
			});
		});
	</script>
<?php }

// Pagination
function theme_pagination($pages = "", $range = 2){
	$showitems = ($range * 2)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == "") {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}   
	if(1 != $pages) {
		// open --->
		echo '
			<!-- pagination -->
			<div class="widget-pagination">
				<div class="hold">
		'; // open
		
					//if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="'.get_pagenum_link(1).'">First Page</a>'; // first page

					//if($paged > 1 && $showitems < $pages) echo '
					if($paged > 1) echo '
					<div class="item before">
						<a href="'.get_pagenum_link($paged - 1).'"><span><i class="fal fa-long-arrow-left"></i></span></a>
					</div>
					'; // before

					for ($i=1; $i <= $pages; $i++) {
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) {
							echo ($paged == $i)? '
								<div class="item current">
									<span>'.$i.'</span>
								</div>
							' // selected
							:
							'
								<div class="item">
									<a href="'.get_pagenum_link($i).'"><span>'.$i.'</span></a>
								</div>
							' //items
							;
						}
					}
		
					//if ($paged < $pages && $showitems < $pages) echo '
					if ($paged < $pages) echo '
					<div class="item next">
						<a href="'.get_pagenum_link($paged + 1).'"><span><i class="fal fa-long-arrow-right"></i></span></a>
					</div>
					'; //next

					//if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($pages).'">Last Page</a>'; //last page
		
		echo '
				</div>
			</div>
			<!-- /pagination -->
		'; //close
	}
}

//** ---- **//

//** -- Taxonomies -- **//
/*
add_action('init', 'create_portfolio_category_tax', 0);
function create_portfolio_category_tax() {
	$labels = array(
		'name'						 => _x('Portfolio Categories', ''),
		'singular_name'				 => _x('Portfolio Category', '')
	);
	register_taxonomy('portfolio_category', array('portfolio'), array(
			'hierarchical'         		 => true,
			'labels'             		 => $labels,
			'show_ui'          		     => true,
			'show_admin_column'  		 => true,
			'update_count_callback'		 => '_update_post_term_count',
			'query_var'					 => true,
			'with_front'				 => true,
			'rewrite'					 => array('slug' => 'portfolio/category'),
		)
	);
}

add_action('init', 'create_team_category_tax', 0);
function create_team_category_tax() {
	$labels = array(
		'name'						 => _x('Team Categories', ''),
		'singular_name'				 => _x('Team Category', '')
	);
	register_taxonomy('team_category', array('team'), array(
			'hierarchical'         		 => true,
			'labels'             		 => $labels,
			'show_ui'          		     => true,
			'show_admin_column'  		 => true,
			'update_count_callback'		 => '_update_post_term_count',
			'query_var'					 => true,
			'with_front'				 => true,
			'rewrite'					 => array('slug' => 'team/category'),
		)
	);
}

add_action('init', 'create_jobs_category_tax', 0);
function create_jobs_category_tax() {
	$labels = array(
		'name'						 => _x('Jobs Categories', ''),
		'singular_name'				 => _x('Jobs Category', '')
	);
	register_taxonomy('jobs_category', array('jobs'), array(
			'hierarchical'         		 => true,
			'labels'             		 => $labels,
			'show_ui'          		     => true,
			'show_admin_column'  		 => true,
			'update_count_callback'		 => '_update_post_term_count',
			'query_var'					 => true,
			'with_front'				 => true,
			'rewrite'					 => array('slug' => 'jobs/category'),
		)
	);
}
*/
// Get Clean Taxonomy
function get_tax_name($args) {
	$terms = get_the_terms($post->ID, $args);
	if (!empty($terms)): foreach($terms as $term) {
		echo ''.$term->name.'';
		unset($term);
	}
	endif;
}

function get_tax_url($args) {
	$terms = get_the_terms($post->ID, $args);
	if (!empty($terms)): foreach($terms as $term) {
		$term_link = get_term_link($term);
		echo ''.esc_url($term_link).'';
		unset($term);
	}
	endif;
}

//** ---- **//

//** -- Post Types -- **//

// Services
add_action('init', 'create_services_post', 0);
function create_services_post() {
	register_post_type(
		'services', array(
			'labels' => array(
				'name' => __('Services'),
				'singular_name' => __('Services')
			),
			
			'menu_position' => 4,
			'menu_icon' => 'dashicons-hammer',
			'capability_type' => 'page',
			'hierarchical' => true,
			
			'public' => true,
			'public_queryable' => true,
			//'exclude_from_search' => true,
			'has_archive' => false,
			'can_export' => true,
			
			'query_var' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			
			'rewrite' => array(
				'slug' => 'services',
				'with_front' => true
			),
			
			'supports' => array (
				'title', 'thumbnail', 'page-attributes', 'revisions', 'excerpt'
			),
		)
	);
}
/*
// Portfolio
add_action('init', 'create_portfolio_post', 0);
function create_portfolio_post() {
	register_post_type(
		'portfolio', array(
			'labels' => array(
				'name' => __('Portfolio'),
				'singular_name' => __('Portfolio')
			),
			
			'menu_position' => 4,1,
			'menu_icon' => 'dashicons-portfolio',
			'capability_type' => 'post',
			'hierarchical' => false,
			
			'public' => true,
			'public_queryable' => true,
			//'exclude_from_search' => true,
			'has_archive' => false,
			'can_export' => true,
			
			'query_var' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			
			'rewrite' => array(
				'slug' => 'portfolio',
				'with_front' => true
			),
			
			'supports' => array (
				'title', 'thumbnail', 'revisions', 'excerpt' 
			),
		)
	);
}

// Team
add_action('init', 'create_team_post', 0);
function create_team_post() {
	register_post_type(
		'team', array(
			'labels' => array(
				'name' => __('Team Members'),
				'singular_name' => __('Team Member')
			),
			
			'menu_position' => 4,2,
			'menu_icon' => 'dashicons-nametag',
			'capability_type' => 'post',
			'hierarchical' => false,
			
			'public' => true,
			'public_queryable' => true,
			//'exclude_from_search' => true,
			'has_archive' => false,
			'can_export' => true,
			
			'query_var' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			
			'rewrite' => array(
				'slug' => 'team',
				'with_front' => true
			),
			
			'supports' => array (
				'title', 'thumbnail', 'revisions', 'excerpt'
			),
		)
	);
}

// Jobs
add_action('init', 'create_jobs_post', 0);
function create_jobs_post() {
	register_post_type(
		'jobs', array(
			'labels' => array(
				'name' => __('Jobs'),
				'singular_name' => __('Job')
			),
			
			'menu_position' => 4,3,
			'menu_icon' => 'dashicons-id-alt',
			'capability_type' => 'post',
			'hierarchical' => false,
			
			'public' => true,
			'public_queryable' => true,
			//'exclude_from_search' => true,
			'has_archive' => false,
			'can_export' => true,
			
			'query_var' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			
			'rewrite' => array(
				'slug' => 'jobs',
				'with_front' => true
			),
			
			'supports' => array (
				'title', 'thumbnail', 'revisions', 'excerpt'
			),
		)
	);
}
*/
// Templates
add_action('init', 'create_templates_post', 0);
function create_templates_post() {
	register_post_type(
		'templates', array(
			'labels' => array(
				'name' => __('Templates'),
				'singular_name' => __('Template')
			),
			
			'menu_position' => 4,8,
			'menu_icon' => 'dashicons-tagcloud',
			'capability_type' => 'page',
			//'hierarchical' => true,
			
			'public' => true,
			'public_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'can_export' => true,
			
			'query_var' => true,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'show_in_admin_bar' => true,
			
			'rewrite' => array(
				'slug' => 'templates',
				'with_front' => true
			),
			
			'supports' => array (
				'title', 'revisions', 'editor'
			),
		)
	);
}

// Hide Yoast in Templates post type
add_action('add_meta_boxes', 'theme_remove_seo_meta_box_templates', 100);
function theme_remove_seo_meta_box_templates() {
	remove_meta_box('wpseo_meta', 'templates', 'normal');
}

/*
// Redirect Single 
add_action('template_redirect', 'theme_redirect_custom_post');
function theme_redirect_custom_post() {
    if (is_singular(array('testiminials'))) {
        wp_redirect(home_url(), 301);
        exit;
    }
}
*/
//** ---- **//

//** -- Post Editor -- **//

// Shortcode
add_shortcode('button', 'button');
function button($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" 		=> 	'',
		"call_to_action" => 	'',
		"target"	=>	'_self',
		"styles"	=>	''
	), $atts));   
	return '<a href="'.$url.'" class="button '.$styles.'" target="'.$target.'">'.$call_to_action.'</a>';
	
}

add_filter('quicktags_settings', 'theme_custom_editor');
function theme_custom_editor($arrange_buttons) {
	$arrange_buttons['buttons'] = 'strong,em,link,ul,ol,li';
	return $arrange_buttons;
}

add_action('admin_print_footer_scripts', 'theme_custom_editor_tags');
function theme_custom_editor_tags() {?>
	<script>
        //button_headline02 = edButtons.length; edButtons[edButtons.length] = new edButton('headline02','h2','<h2 class="h2">','</h2>');
		//button_headline03 = edButtons.length; edButtons[edButtons.length] = new edButton('headline03','h3','<h3 class="h3">','</h3>');
		//button_headline04 = edButtons.length; edButtons[edButtons.length] = new edButton('headline04','h4','<h4 class="h4">','</h4>');
		//button_cta = edButtons.length; edButtons[edButtons.length] = new edButton('ed_button','button','[button url="" target="_self" call_to_action="" styles=""]','');
	</script>
<?php }

//** ---- **//
?>