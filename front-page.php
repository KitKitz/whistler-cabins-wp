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

		<!-- FEATURED ACTIVITES SECTION -->
		<section class="featured-section">
			<?php
				if (function_exists('get_field')){
					if(get_field('fbp_section_title')){
						?><h1><?php the_field('fbp_section_title');?></h1><?php
					}
					if(get_field('fbp_section_content')){
						?><p><?php the_field('fbp_section_title');?></p><?php
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

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
