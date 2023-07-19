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
		
	<div class="entry-content">

		<section class="hero"> 
			<?php 
			the_title( '<h1 class="align-left-title">', '</h1>' );
			whistler_cabins_post_thumbnail(); 
			?>
		</section>

		<?php
		//display the content of the post

		if (function_exists('get_field')){?> 

			<section>

				<?php
				if (get_field('activity_text_1')){?>

					<p class="activity-intro"><?php the_field('activity_text_1');?></p>
				
				<?php } 

				
				if ( get_field( 'activity_image_1') ) { ?>
				<div class="activity-offset-1">
					<div class="activity-offset-2">
						<div class="activity-1">
							<?php 
							
								?>
								<div class="activity-image-wrap"> 	
									<?php
									echo wp_get_attachment_image( get_field( 'activity_image_1' ), 'large', '');
									?>
								</div>
								<?php
				}
						
							if ( get_field( 'activity_text_2') ) {?>
								
								<p><?php the_field('activity_text_2');?></p>
								
							<?php } ?>
						</div>

						<div class="activity-2">
							<?php
							if ( get_field( 'activity_image_2') ) {
								?>
								<div class="activity-image-wrap"> 
								<?php
								echo wp_get_attachment_image( get_field( 'activity_image_2' ), 'large', '');
								?>
								</div>
								<?php
							}
											
							if ( get_field( 'activity_text_3') ) {?>
								
								<p><?php the_field('activity_text_3');?></p>
							<?php } 
							?>
						</div>
					</div> 
				</div>

			</section>

			<section class="affiliate-section">

				<?php
				if (get_field('affiliate_title')){?>

					<h2><?php the_field('affiliate_title');?></h2>
				
				<?php }

				if ( get_field( 'affiliate_content') ) {?>
					
					<p><?php the_field('affiliate_content');?></p>
					
				<?php }

				if ( get_field( 'affiliate_button') ) {?>
					
					<a href="#" class="button-link"><?php the_field('affiliate_button');?></a>
					
				<?php }

				?>
				
			</section>

			<?php		
		}
		?>	

		<?php
			the_content();
		?>
	</div>

	<footer class="entry-footer">
		<?php whistler_cabins_entry_footer(); ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
