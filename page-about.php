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

		$size = 'medium';
		?>
		<h1><?php the_title();?></h1>
		<section class="about-us">
		<?php
			if (function_exists('get_field')){
				?>
				<div class="about-grid">
				<?php
				$image1 = get_field('about_photo_1');
				if(!empty($image1)){ 
					echo wp_get_attachment_image($image1, $size);
					
				}
				if(get_field('about_text_1')){
					?><p><?php the_field('about_text_1');?></p><?php
				}
				$image2 = get_field('about_photo_2');
				if(!empty($image2)){
					echo wp_get_attachment_image($image2, $size);
				}
				if(get_field('about_text_2')){
					?><p><?php the_field('about_text_2')?></p><?php
				}
				?>
				</div>
				</section>
				<section class="about-video">
				<?php
				//video url: https://youtu.be/pqRBvwsh7F4 
				if(get_field('about_video')){
					?><div class="video-wrapper"><?php
					$iframe = get_field('about_video');
					
				// Use preg_match to find iframe src.
				preg_match('/src="(.+?)"/', $iframe, $matches);
				$src = $matches[1];

				// Add extra parameters to src and replace HTML.
				$params = array(
					'controls'  => 0,
					'hd'        => 1,
					'autohide'  => 1,
					'autoplay'	=> 1,
					'loop'		=> 1,
					'mute'		=> 1,
					'playlist'  => 'pqRBvwsh7F4',
				);
				$new_src = add_query_arg($params, $src);
				$iframe = str_replace($src, $new_src, $iframe);

				// Add extra attributes to iframe HTML.
				$attributes = 'frameborder="0" width="800" height="450"';
				$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

				// Display customized HTML.
				echo $iframe;
				?>
				<div class="video-overlay"></div>
				</div>
				<?php

				if(get_field('about_page_heading')){
					?><h2><?php the_field('about_page_heading');?></h2><?php
				}
				?>
				</section>
				<section class="instagram-feed">
				<?php

				if(get_field('follow_us_instagram')){
					?><h2><?php the_field('follow_us_instagram');?></h2><?php
				}
				if(get_field('instagram_link')){
					?><a href="<?php the_field('instagram_link');?>" target="_blank" rel="noreferrer">@alpenglowcabins</a><?php
				}
				if(get_field('instagram_feed')){
					the_field('instagram_feed');
				}

				}
				?>
				</section><?php
			}
		endwhile;
		?>

	</main><!-- #main -->

<?php
get_footer();
