<?php

/************************************************************************/
/* FUNCTIONS
/************************************************************************/

	// why don't ya add somethin' already?!
	

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
add_action( 'after_setup_theme', 'theme_setup' );


/************************************************************************/
/* wp_head();
/************************************************************************/

// Add Stylesheets
function theme_styles() {
	wp_enqueue_style( 'layout', get_stylesheet_directory_uri() . '/assets/css/layout.css' );
	wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function theme_scripts() {
	wp_register_script( 'jquery-3.1.1', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', false, NULL, true );
	wp_enqueue_script( 'jquery-3.1.1' );
	
	wp_register_script('script', get_template_directory_uri() . '/assets/js/scripts-min.js', '', NULL, true);
	wp_enqueue_script('script');
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );


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
add_filter( 'tiny_mce_before_init', 'color_options' );


/************************************************************************/
/* OTHER CSS/JS FUNCTIONS
/************************************************************************/

function remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );

function remove_gen_version() {
	return '';
}
add_filter( 'the_generator', 'remove_gen_version', 10, 2 );

// Add preload tag to web font scripts and styles
function add_style_attributes($html, $handle) {
	if ( 'layout' !== $handle && 'styles' !== $handle ){
		return $html;
	}
	return str_replace( ' href', ' preload href', $html );
}
add_filter( 'style_loader_tag', 'add_style_attributes', 10, 2 );

function add_script_attributes($tag, $handle) {
	if ( 'fontawesome' !== $handle ){
		return $tag;
	}
	return str_replace( ' src', ' preload src', $tag );
}
add_filter( 'script_loader_tag', 'add_script_attributes', 10, 2 );


/************************************************************************/
/* ADD OPTIONS PAGE via ACF
/************************************************************************/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false, 
		'parent_slug'	=> ''
	));
}


/************************************************************************/
/* ADD BROWSER SPECIFIC BODY CLASSES
/************************************************************************/

function custom_body_classes($classes){
    // the list of WordPress global browser checks
    // https://codex.wordpress.org/Global_Variables#Browser_Detection_Booleans
    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    // check the globals to see if the browser is in there and return a string with the match
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));
    return $classes;
}
// call the filter for the body class
add_filter('body_class', 'custom_body_classes');


/************************************************************************/
/* REMOVE EMOJI STUFF
/************************************************************************/

function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_wp_emojicons() {
	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_filter( 'emoji_svg_url', '__return_false' );









