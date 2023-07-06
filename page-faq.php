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
		<section class="hero">
			<!-- Page title and overview (acf) -->
			<h1 class="page-title"><?php the_title() ?></h1> <?php

			if( function_exists('get_field') ) :
				if( get_field('faq_page_overview') ) : ?>
					<p><?php the_field('faq_page_overview') ?></p> <?php
				endif;
			endif; ?>
		</section>

		<?php 
		// Get FAQ CPT
		$args = array (
			'post_type'     => 'whi-faq',
			'orderby'			 	=> 'date',
			'order'			 		=> 'asc',
		);
		$query = new WP_Query($args); 


		if( $query -> have_posts() ) : ?>
			<?php
				while ( $query->have_posts() ) :
					$query -> the_post(); ?>
					<section class="topic-qa">
						<button class="btn-topic"><p><?php the_title(); ?></p></button> <?php
						
						// Check if ACF Repeater rows exist and loop 
						if( function_exists('get_field') && have_rows( 'faq_repeater' ) ) :
							while( have_rows( 'faq_repeater' ) ) : the_row() ?>
								<div class="single-qa" style="display: none;">
									<button class="btn-qa"><p><?php the_sub_field( 'faq_question' ); ?></p></button>
									<p style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-in-out;"><?php the_sub_field( 'faq_answer' ); ?></p>
								</div> <?php
							endwhile;
						
						else: ?>
						<p><?php _e( 'Sorry, no FAQs to display.', 'whistler-cabins' ); ?></p> <?php
						endif; ?> 

					</section> <?php
				endwhile;
				wp_reset_postdata();
		
		else: ?>
			<p><?php _e( 'Sorry, no FAQs to display.', 'whistler-cabins' ); ?></p> <?php
		
		endif; 
	endwhile; ?>
	
	</main>

<?php
get_footer();
