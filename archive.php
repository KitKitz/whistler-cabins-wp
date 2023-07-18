<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<section class="hero">
				<?php
				single_term_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</section class="hero">

			<?php
			get_sidebar(); ?>
			<section class="taxonomy-content">
				<?php
				while ( have_posts() ) :
					?>
						<?php
						the_post();
						?>

							<article>
								<div class="activities-info"> 
									<h3><?php the_title(); ?></h3>
									<a href="<?php the_permalink();?>" class="button-link">View Activity</a>
								</div>
								<?php the_post_thumbnail( 'activities-card' );?>
							</article>		
					
							<?php
				endwhile; ?>
			</section>
			<?php
			
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main>

<?php
get_footer();
