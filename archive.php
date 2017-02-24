
<?php get_header(); ?>

	<div class="wrap">

		<section class="content" role="main">
			asdf
			<?php if ( have_posts() ): 
				while ( have_posts() ) : the_post(); ?>
				
					<article>
						<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
						<?php the_content(); ?>
					</article>
				
				<?php endwhile; ?>
					
				<div class="pagination">
					<?php
						$image_path = get_template_directory_uri();
						
						the_posts_pagination( array(
							'prev_text'          => __( '<span><img src="'.$image_path.'/assets/img/arrows-prev.png" /></span> Prev', 'twentyfifteen' ),
							'next_text'          => __( 'Next <span><img src="'.$image_path.'/assets/img/arrows-next.png" /></span>', 'twentyfifteen' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'twentyfifteen' ) . ' </span>',
						) );
					?>		
				</div>
				
			<?php endif; ?>
		
		</section>
	
	</div>

<?php get_footer(); ?>