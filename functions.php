<?php

/************************************************************************/
/* FUNCTIONS
/************************************************************************/

	// External files
	

/************************************************************************/
/* WYSIWYG COLOR PALETTE
/************************************************************************/

function my_mce4_options( $init ) {
$default_colors = '
	"141414", "Black",
	"FFFFFF", "White"
';
// Add custom colors here
$custom_colors = '
            
';
$init['textcolor_map'] = '['.$default_colors.','.$custom_colors.']'; // build color grid default+custom colors
$init['textcolor_rows'] = 6; // enable 6th row for custom colors in grid
return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

// Remove link from image 
add_filter( 'the_content', 'attachment_image_link_remove_filter' );
function attachment_image_link_remove_filter( $content ) {
	$content = 	preg_replace( array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}', '{ wp-image-[0-9]*" /></a>}'), array('<img','" />'), $content);
	return $content;
}

/************************************************************************/
/* THEME SUPPORT
/************************************************************************/

if ( function_exists( 'add_theme_support' ) ) {
	// Add Menu Support
	add_theme_support('menus');
	
	
	// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');
	add_image_size('large', 700, '', true); // Large Thumbnail
	add_image_size('medium', 250, '', true); // Medium Thumbnail
	add_image_size('small', 120, '', true); // Small Thumbnail
	add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
}

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'main-menu' => 'Main Navigation',
			'footer-menu' => 'Footer Navigation'
		)
	);
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' 				=> 'Default Sidebar',
		'id' 				=> 'default-sidebar',
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 		=> '</div>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	));
}

/************************************************************************/
/* ACTIONS & FILTERS
/************************************************************************/

add_action( 'wp_enqueue_scripts', 'bigfish_script_enqueuer' );
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter('the_generator', 'remove_gen_version');

/************************************************************************/
/* wp_head();
/************************************************************************/

// Add Stylesheets
function bigfish_script_enqueuer() {
	wp_register_style( 'layout', get_stylesheet_directory_uri().'/assets/css/layout.css', '', '' );
	wp_enqueue_style( 'layout' );
	wp_register_style( 'styles', get_stylesheet_directory_uri().'/assets/css/styles.css', '', '' );
	wp_enqueue_style( 'styles' );
}

// Remove version numbers
function remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

function remove_gen_version() {
	return '';
}

?>