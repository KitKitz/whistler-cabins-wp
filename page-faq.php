<?php
	get_header();
?>

<main id="primary" class="site-main">
	
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<h1><?php the_title() ?></h1>
		<?php
			if( function_exists('get_field') ) :
				if( get_field('faq_page_overview') ) : ?>
					<p><?php the_field('faq_page_overview') ?></p>
				<?php
				endif;
			endif;
		?>

		<?php 
		// Get FAQ CPT
		$args = array (
			'post_type'     => 'whi-faq',
			'orderby'			 	=> 'date',
			'order'			 		=> 'asc',
		);
		$query = new WP_Query($args); 

		if( $query -> have_posts() ) : ?>
		<section>
			<div class="topic-btn-wrapper">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post(); ?>
						<button class="topic"><?php the_title(); ?></button>
					<?php
				endwhile; ?>
			</div>
			
			<?php 
			while ( $query->have_posts() ) :
				$query -> the_post(); 

				// Check if ACF Repeater rows exist and loop 
				if( function_exists('get_field') && have_rows( 'faq_repeater' ) ) : ?>

					<div class="qa-wrapper"> <?php
						while( have_rows( 'faq_repeater' ) ) : the_row() ?>

							<article class="single-qa" >

								<button class="question">
									<span><?php the_sub_field( 'faq_question' ); ?></span>
								</button>

								<div class="answer-wrapper">
									<p><?php the_sub_field( 'faq_answer' ); ?></p>
								</div>
								
							</article> <?php

						endwhile; ?>
					</div> <?php
					
				else: ?>	
					<div><p><?php _e( 'Sorry, no FAQs to display.', 'whistler-cabins' ); ?></p></div> <?php
				
				endif;

			endwhile;
				wp_reset_postdata(); ?>
			<?php

		else: ?>
		<p><?php _e( 'Sorry, no FAQs to display.', 'whistler-cabins' ); ?></p> <?php
		
		endif;

	endwhile; ?>

</main>

<?php
get_footer();
