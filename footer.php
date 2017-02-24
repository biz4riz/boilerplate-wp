
	<footer role="contentinfo">
		<div class="wrap">
			<nav id="footer-menu" role="navigation">
				<?php wp_nav_menu(
				array(
					'theme_location'  => 'footer-menu',
					'container_class' => '',
					'container_id'    => 'footer-menu',
					'menu_class'      => 'menu',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'items_wrap'      => '<ul>%3$s</ul>',
					'depth'           => 0,
					'walker'          => ''
					)
				); ?>
			</nav>
			<small class="footer-content">&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?></small>
		</div>
	</footer>
</div> <!-- end container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type='text/javascript' src="<?php echo get_template_directory_uri(); ?>/assets/js/scripts-min.js"></script>
<?php wp_footer(); ?>

</body>
</html>