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
		<div class="hero-banner">
			<?php
			if(function_exists('get_field')){
				if(get_field('home_hero_title')){
					?><h1><?php the_field('home_hero_title');?></h1><?php
				}
				if(get_field('home_hero_content')){
					?><p><?php the_field('home_hero_content');?></p><?php
				}
			}
			?>
		</div>

		<!-- CABINS SECTION  -->
		<div class="cabins">
			<h1>Our Cabins</h1>
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
							<?php if(function_exists('get_field')){
							if (get_field('cabin_view')){
								?><p><?php the_field('cabin_view');?></p><?php
							}
							if (get_field('cabin_sleeps')){
								?><p><?php the_field('cabin_sleeps');?></p><?php
							}
							}?>
							<a href="<?php the_permalink(); ?>">View Cabin</a>
							</article>
							<?php
							
						}
						wp_reset_postdata();
					}
					?>

		</div>


		<!-- FEATURED ACTIVITES SECTION -->
		<section class="featured-section">
			<?php
				if (function_exists('get_field')){
					if(get_field('fbp_section_title')){
						?><h1><?php the_field('fbp_section_title');?></h1><?php
					}
					if(get_field('fbp_section_content')){
						?><p><?php the_field('fbp_section_content');?></p><?php
					}
					if(get_field('fbp_section_button')){
						?><a href="<?php get_post_type_archive_link( 'post' );?>"><?php the_field('fbp_section_button');?></a><?php
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
						
							<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail(); ?>
							<h3><?php the_title(); ?></h3>
							</a>
					</article>
							<?php
							
						}
						wp_reset_postdata();
					}
			?>
		</section>
		
		<!-- GIFT CARD TEMPLATE PART SECITION -->
		<?php get_template_part('template-parts/content', 'gift-card');?>

		<!-- MAP SECTION -->
		<section class="home-map-section">
			<?php

			if (get_field('map_legend')) {
				$map_legend = get_field('map_legend'); // Assuming 'map_legend' is the repeater field name
		
				if ($map_legend) {
					foreach ($map_legend as $row) {
						$home_map_icon = $row['home_map_icon']; 
						$home_map_text = $row['home_map_text']; 

						?>
						<div class="map-item">
						<img class="home-map-icon" src="<?php echo $home_map_icon; ?>" alt="<?php echo $home_map_text; ?>">
						<p class="home-map-text"><?php echo $home_map_text; ?></p>
						</div>
					<?php
					}
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
			
			?>
		</section>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
