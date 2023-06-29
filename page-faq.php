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
		<header class="page-header">
			<h1 class="page-title"><?php the_title() ?></h1>	
		</header>

		<?php 
			if( function_exists('get_field') ) :
				if( get_field('faq_page_overview') ) : ?>
					<p><?php the_field('faq_page_overview') ?></p>
				<?php
				endif;

				// Get FAQ CPT
				$args = array (
					'post_type'     => 'whi-faq',
					'orderby'			 	=> 'date',
					'order'			 		=> 'asc',
				);
				$query = new WP_Query($args); 

				if( $query -> have_posts() ) :
					while ( $query->have_posts() ) :
						$query -> the_post(); ?>
						<section>
							<h2><?php the_title(); ?></h2> 
						</section>
						<?php
					endwhile;
					wp_reset_postdata();

				else: ?>
					<p><?php _e( 'Sorry, no FAQs available.' ); ?></p>
				<?php
				endif;
			endif;
		?>

	</main>

<?php
get_sidebar();
get_footer();
