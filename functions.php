<?php

/************************************************************************/
/* FUNCTIONS
/************************************************************************/

	// External files
	

/************************************************************************/
/* THEME SUPPORT
/************************************************************************/

function theme_setup(){
	
	add_theme_support( 'title-tag' );
	
	add_theme_support('menus');
	
	add_theme_support( 'custom-logo', array(
		'width'       => 400,
		'height'      => 100,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	add_theme_support('post-thumbnails');
	//add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
	
	register_nav_menus( array(
		'main' => __('Main Menu', 'boilerplate-wp' ),
		'footer' => __('Footer Menu', 'boilerplate-wp' ),
		'social' => __('Social Menu', 'boilerplate-wp' ),
	) );
	
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption'
	) );
	
	register_sidebar(array(
		'name' 				=> 'Default Sidebar',
		'id' 					=> 'default-sidebar',
		'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>',
	));
};

/************************************************************************/
/* wp_head();
/************************************************************************/

// Add Stylesheets
function theme_styles() {
	wp_enqueue_style( 'layout', get_stylesheet_directory_uri().'/assets/css/layout.css' );
	wp_enqueue_style( 'styles', get_stylesheet_directory_uri().'/assets/css/styles.css' );
}

// Add typekit
function theme_typekit(){
	wp_enqueue_script( 'theme_typekit', '//use.typekit.net/TYPEKIT_PROJECT_ID.js' );
}

function theme_typekit_const(){
	if( wp_script_is( 'theme_typekit', 'done' ) ):
		echo '<script>try{Typekit.load({ async: true });}catch(e){}</script>';
	endif;
}

/************************************************************************/
/* WYSIWYG COLOR PALETTE
/************************************************************************/

function color_options( $init ) {
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

/************************************************************************/
/* OTHER FUNCTIONS
/************************************************************************/

function remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
function remove_gen_version() {
	return '';
}

/************************************************************************/
/* ACTIONS & FILTERS
/************************************************************************/

add_action( 'after_setup_theme', 'theme_setup' );
add_action( 'wp_enqueue_scripts', 'theme_styles' );
add_action( 'wp_enqueue_scripts', 'theme_typekit' );
add_action( 'wp_head', 'theme_typekit_const' );
add_filter('tiny_mce_before_init', 'color_options');
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter('the_generator', 'remove_gen_version');

