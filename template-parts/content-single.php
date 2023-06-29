<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Whistler_Cabins
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		?>
	</header><!-- .entry-header -->

	<?php whistler_cabins_post_thumbnail(); ?>
				
	
		<?php
		//display the content of the post

		if (function_exists('get_field')){?> 

			<section>

				<?php
				if (get_field('activity_text_1')){?>

					<p><?php the_field('activity_text_1');?></p>
				
				<?php }

				if ( get_field( 'activity_image_1') ) {
					echo wp_get_attachment_image( get_field( 'activity_image_1' ), 'large', '');
				}
			
				if ( get_field( 'activity_text_2') ) {?>
					
					<p><?php the_field('activity_text_2');?></p>
					
				<?php }

				if ( get_field( 'activity_image_2') ) {
					echo wp_get_attachment_image( get_field( 'activity_image_2' ), 'large', '');
				}

				if ( get_field( 'activity_text_3') ) {?>
					
					<p><?php the_field('activity_text_3');?></p>
					
				<?php }

				?>

			</section>

			<section>

				<?php
				if (get_field('affiliate_title')){?>

					<h2><?php the_field('affiliate_title');?></h2>
				
				<?php }

				if ( get_field( 'affiliate_content') ) {?>
					
					<p><?php the_field('affiliate_content');?></p>
					
				<?php }

				if ( get_field( 'affiliate_button') ) {?>
					
					<a href="#"><?php the_field('affiliate_button');?></a>
					
				<?php }

				?>
				
			</section>

			<?php		
		}
		?>	
			
		

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'whistler-cabins' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php whistler_cabins_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
