<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Whistler_Cabins
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			?>

			<section class="hero">
				<?php
				// Output the Featured Image of Blog Index: https://wordpress.stackexchange.com/questions/335003/using-featured-image-of-blog-archive-page
				$blog_index = get_option('page_for_posts');
				if ( $blog_index && has_post_thumbnail( $blog_index ) ){
					$thumb_id = get_post_thumbnail_id( $blog_index );
					echo wp_get_attachment_image( $thumb_id, 'full' );
				}

				if (function_exists('get_field')){ 
					
					if (get_field('activities_hero_title', 14)){
						echo '<h1>';
						the_field('activities_hero_title', 14);
						echo '</h1>';
					}
					
					if ( get_field( 'activities_hero_content', 14 ) ) {
						echo '<p>';
						the_field( 'activities_hero_content', 14 );
						echo '</p>';
					}
				}
				?>
			</section>
			
			<?php
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
			
					if( $query->have_posts() ) :  
					
						echo '<h2>' . esc_html( $term->name ) . '</h2>';
						$counter = 0;
						$total_posts = $query->found_posts;
						
						while( $query->have_posts() ) : 
						$query->the_post(); 
						$counter++;
						?>
				
						<article>
							<h3><?php the_title(); ?></h3>
							<?php the_post_thumbnail( 'medium' );?>
							<a href="<?php the_permalink();?>" class="button-link">View Activity</a>
						</article>
							
			
						<?php 

						// display the Get More Posts button when reaching the third post
						if ( $counter == 3 && $counter < $total_posts ) {
							?>
							<button class="get-more-posts">Get More Posts</button>
							<div class="hidden-posts" style="display:none;">
							<?php
						}
										
						endwhile; 
						echo '</div>';
						wp_reset_postdata();

																			
					endif; ?>
			
				<?php endforeach;
			
			endforeach; 

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
