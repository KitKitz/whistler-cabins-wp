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

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
	?>

	<?php
	if (function_exists('get_field')) {
		?>
		<div class="contact-page-business-info">
		<?php
			if (get_field('business_address')) {
				$address = get_field('business_address');
				echo '<p>Address: ' . $address . '</p>';
			}
			
			if (get_field('business_phone')) {
				$phone = get_field('business_phone');
				echo '<p>Phone: ' . $phone . '</p>';
			}
			
			if (get_field('business_email')) {
				$email = get_field('business_email');
				echo '<p>Email: <a href="mailto:' . $email . '">' . $email . '</a></p>';
			}
		?>
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
	?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
