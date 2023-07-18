<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :
			?>

			<section class="hero">
				<?php
				$blog_index = get_option('page_for_posts');
				if ( $blog_index && has_post_thumbnail( $blog_index ) ){
					$thumb_id = get_post_thumbnail_id( $blog_index );
					echo wp_get_attachment_image( $thumb_id, 'full' );
				}
				?>

				<div class="align-center"> 
					<h1><?php echo get_the_title(); ?></h1>
					
					<?php
					if (function_exists('get_field')){
						if(get_field( 'activities_hero_content', 14 )) {
							?>
							<p><?php the_field( 'activities_hero_content' , 14 ); ?></p>
							<?php
						}
					} 
					?>
				</div>
			</section>
			
			<?php
			get_sidebar();
			//display the posts sorted by the categories
			
			$taxonomies = get_object_taxonomies( array( 'post_type' => 'post' ) );
			
			foreach( $taxonomies as $taxonomy ) :
			
				$terms = get_terms( $taxonomy );
			
				foreach( $terms as $term ) : ?>

					<?php
					$args = array(
							'post_type' => 'post',
							'posts_per_page' => -1,  
							'tax_query' => array(
								array(
									'taxonomy' => $taxonomy,
									'field' => 'slug',
									'terms' => $term->slug,
								)
							)
			
						);

					$query = new WP_Query($args);
			
					if( $query->have_posts() ) :  ?>
						
						<section class="taxonomy-content">
							<h2><?php echo esc_html( $term->name ); ?></h2>
							<?php 
							$counter = 0;
							$total_posts = $query->found_posts;
							
							while( $query->have_posts() ) : 
							$query->the_post(); 
							$counter++;
							?>
					
							<article>
								<div class="activities-info"> 
									<h3><?php the_title(); ?></h3>
									<a href="<?php the_permalink();?>" class="button-link">View Activity</a>
								</div>
								<?php the_post_thumbnail( 'activities-card' );?>
					
							</article>
							
							<?php 

							// display the Get More Posts button when reaching the third post
							if ( $counter == 3 && $counter < $total_posts ) {
								?>
								<button class="more">More Activites</button>
								<section class="hidden-posts" style="display:none;">
								<?php
							}
							endwhile; ?>
							</section>
						</section>

						<?php 
						wp_reset_postdata();
																			
					endif; 
				
				endforeach;
			
			endforeach; 

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main>

<?php
get_footer();
