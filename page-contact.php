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
			<h1><?php the_title();?></h1>
			<?php
			get_template_part( 'template-parts/content', 'contact-form' );
			
			if (function_exists('get_field')) {
				?>
				<div class="contact-page-business-info">
				<?php
					if (get_field( 'business_address', 'option' )) : ?>
					<div class="business-info-container">
						<div class="business-info-item">
							<?php get_template_part('assets/icons/pin'); ?>
							<div><p>Location</p><address><?php the_field( 'business_address', 'option' )?></address></div>
						</div>
							<?php
						endif; 
		
						if (get_field( 'business_phone', 'option' )) : ?>
						<div class="business-info-item">
							<?php get_template_part('assets/icons/phone'); ?>
							<div><p>Phone</p><a href="tel:<?php the_field( 'business_phone', 'option' )?>"><?php the_field( 'business_phone', 'option' )?></a></div>
						</div>
							<?php
						endif;
		
						if (get_field( 'business_email', 'option' )) : ?>
						<div class="business-info-item">
							<?php get_template_part('assets/icons/email'); ?>
							<div><p>Email</p><a href="mailto:<?php the_field( 'business_email', 'option')?>"><?php the_field( 'business_email', 'option' )?></a></div>
						</div>
							<?php
						endif;
						?>
					</div>
				</div>
		
				<?php
				$contact_map = get_field('contact_map');
				$map_icon = get_field('contact_map_icon');
				if( $contact_map ): ?>
					<div class="acf-map contact-page-map" data-zoom="16">
						<div class="marker" 
						data-lat="<?php echo esc_attr($contact_map['lat']); ?>" 
						data-lng="<?php echo esc_attr($contact_map['lng']); ?>"
						data-icon="<?php echo $map_icon?>"></div>
					</div>
				<?php endif; 
			}

		endwhile; // End of the loop.
	?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
