<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Whistler_Cabins
 */

get_header();
?>
		
	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

		?>
		<!-- HERO SECTION  -->
		<section class="hero">
			<?php
			if (has_post_thumbnail()){
				the_post_thumbnail();
			}
			
			if(function_exists('get_field')){
				?>
				<div class="align-center">
					<?php 
					if(get_field('home_hero_title')){
						?><h1><?php the_field('home_hero_title');?></h1><?php
					}
					if(get_field('home_hero_content')){
						?><p><?php the_field('home_hero_content');?></p><?php
					}
					?>
				</div>
				<?php 
			}	
			?>
			
		</section>

		<!-- CABINS SECTION  -->
		<section class="cabins">
			
			<?php
			if(function_exists('get_field') && get_field('cabins_section_title')){ ?>
				<h2><?php the_field('cabins_section_title') ?></h2><?php
			}
			?>

			<?php
			$tax_query[] = array(
				'taxonomy' 	=> 'product_visibility',
				'field'		=> 'name',
				'terms'		=> 'featured',
				'operator'	=> 'IN',
			);

			$args = array (
				'post_type' 	 =>'product',
				'posts_per_page' => 3,
				'tax_query'		 => $tax_query
			);

			$query = new WP_Query ($args);
				if($query->have_posts()){
					while($query->have_posts()){
						$query->the_post();
						$product = wc_get_product(get_the_ID());
						?>

						<article>
							<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?></a>
							<h3><?php the_title(); ?></h3>
							<?php
							if(function_exists('get_field')){
								if (get_field('cabin_sleeps')){
									?><div class="cabin-info guests"><?php get_template_part('icons/user');?><p><?php the_field('cabin_sleeps');?></p></div><?php
								}
								if (get_field('cabin_view')){
									?><div class="cabin-info view"><?php get_template_part('icons/sea-sun');?><p><?php the_field('cabin_view');?></p></div><?php
								}
							}
							?>
							<a href="<?php the_permalink(); ?>" class="button-link">View Cabin</a>
						</article>
						<?php
						}
						wp_reset_postdata();
					}

					?>
				
				<a href="<?php echo wc_get_page_permalink( 'shop' ) ?>" class="button-link">
					<?php
					if(function_exists('get_field') && get_field('cabins_section_button')){ ?>
					<?php the_field('cabins_section_button') ?><?php
					}?>
				</a>

			</section>

		<!-- GIFT CARD SECTION (TEMPLATE PART) -->
		<?php get_template_part('template-parts/content', 'gift-card');?>
			
		<!-- FEATURED ACTIVITES SECTION -->
		<section class="featured-activities">
			
			<?php
				if (function_exists('get_field')){
					if(get_field('fbp_section_title')){
						?>
						<h2><?php the_field('fbp_section_title');?></h2><?php
					}
					if(get_field('fbp_section_content')){
						?><p><?php the_field('fbp_section_content');?></p><?php
					}
					if(get_field('fbp_section_button')){
						?><a href="<?php get_post_type_archive_link( 'post' );?>" class="button-link"><?php the_field('fbp_section_button');?></a><?php
					}
				}

				// ADD ARGS HERE (will modify when more activity content)
				$args = array (
					'post_type' 	 =>'post',
					'posts_per_page' => 2,
				);

				$query = new WP_Query ($args);
					if($query->have_posts()){
						while($query->have_posts()){
							$query->the_post();
							?>

							<article>
								<h3><?php the_title(); ?></h3>
								<?php the_post_thumbnail( 'large' );?>
								<a href="<?php the_permalink();?>" class="button-link">View Activity</a>
							</article>
							
							<?php
						}
						wp_reset_postdata();
					}
				?>
			</section>
		
		<!-- MAP SECTION -->
		<section class="map">
			<?php

			if (get_field('map_legend')) {
				$map_legend = get_field('map_legend');

				if ($map_legend) {
					?>
					<div class="map-info">
						<?php
						foreach ($map_legend as $row) {
							$home_map_icon = $row['home_map_icon']; 
							$home_map_text = $row['home_map_text']; 
							?>
							
								<img class="home-map-icon" src="<?php echo $home_map_icon; ?>" alt="<?php echo $home_map_text; ?>">
								<p class="home-map-text"><?php echo $home_map_text; ?></p>
							<?php
						}
						?>
					</div>
					<?php
				}
			}
			
			if (have_rows('locations')) :
				?>
				<div class="acf-map">
					<?php while (have_rows('locations')) : the_row();
						$location = get_sub_field('location');
						$map_icon = get_sub_field('icon');
						?>
						<div class="marker" 
							data-lat="<?php echo $location['lat']; ?>" 
							data-lng="<?php echo $location['lng']; ?>" 
							data-icon="<?php echo $map_icon; ?>">
								<h4><?php the_sub_field('title'); ?></h4>
								<p><?php the_sub_field('description'); ?></p>
						</div>
					<?php endwhile; ?>
				</div>
			<?php
			endif;
		endwhile;
			?>
		</section>

	</main>

<?php
get_footer();
