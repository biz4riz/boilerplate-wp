<!doctype html>
<html lang="en">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />

<?php wp_head(); ?>

<script src="https://use.typekit.net/sqd7hdy.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<script src="https://use.fontawesome.com/68a48c13a2.js"></script>
</head>

<?php 
global $wp_query;
$post_id = $wp_query->post->ID;
$post = get_post( $post_id );
$slug = $post->post_name;
?>
<body id="<?php echo $slug; ?>" <?php body_class(); ?>>

<div id="<?php if ($template_name) { echo 'template_' . $template; } ; ?>" class="container">
	<header role="banner">
		<div class="wrap">
			<div class="sm_12">
			
				<?php the_custom_logo(); ?>
				
				<a href="#menu" id="nav_btn">
					<div id="nav_icon">
						<span></span>
						<span></span>
						<span></span>
					</div>
					Menu
				</a>
				<nav id="menu" role="navigation">
					<?php wp_nav_menu(
					array(
						'theme_location'  => 'main-menu',
						'container_class' => '',
						'container_id'    => 'main_menu',
						'menu_class'      => '',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'items_wrap'      => '<ul>%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
						)
					); ?>
				</nav>
				
			</div>
		</div>
	</header>