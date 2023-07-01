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
		
		if (have_rows('locations')) :
			?>
			<div class="acf-map">
				<?php while (have_rows('locations')) : the_row();
					$location = get_sub_field('location');
					?>

					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
						<h4><?php the_sub_field('title'); ?></h4>
						<p><?php the_sub_field('description'); ?></p>
					</div>
				<?php endwhile; ?>
			</div>
		<?php
		endif;
	}
	?>

	<script 
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpY5bD4tfgPVeApcgQBI0sR76IAX8NrLg&callback=Function.prototype"
	></script>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
