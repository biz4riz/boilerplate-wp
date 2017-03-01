<?php
/*
Template Name: TEMPLATE_NAME
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ) : the_post(); ?>

	<section role="main">
		<div class="wrap">
			<article>
				<header>
					<h1><?php the_title(); ?></h1>
				</header>
					
				<?php the_content(); ?>
				
			</article>
		</div>
	</section>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>