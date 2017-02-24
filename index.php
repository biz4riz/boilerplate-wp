<?php get_header(); ?>

<section>
	<div class="wrap">		
		<div class="content" role="main">
			<?php if ( have_posts() ): ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
			<article>
				<header>
					<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
				</header>
				
				<?php the_content(); ?>
				
				<footer></footer>
			</article>
			<?php endwhile; ?>
			<?php else: ?>
			<h2>No posts to display</h2>
			<?php endif; ?>
		</div>
		
		<?php get_sidebar(); ?>
	
	</div>
</section>

<?php get_footer(); ?>