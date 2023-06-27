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
		<h1><?php the_title();?></h1>
		<?php
		$size = 'medium';
			if (function_exists('get_field')){
				if(get_field('about_page_heading')){
					?><h1><?php the_field('about_page_heading');?></h1><?php
				}
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
				//video url: https://youtu.be/pqRBvwsh7F4 
				if(get_field('about_video')){
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
				);
				$new_src = add_query_arg($params, $src);
				$iframe = str_replace($src, $new_src, $iframe);

				// Add extra attributes to iframe HTML.
				$attributes = 'frameborder="0"';
				$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

				// Display customized HTML.
				echo $iframe;

				if(get_field('follow_us_instagram')){
					?><h1><?php the_field('follow_us_instagram');?></h1><?php
				}
				if(get_field('instagram_link')){
					?><a href="<?php the_field('instagram_link');?>" target="_blank" rel="noreferrer">@alpenglowcabins</a><?php
				}
				if(get_field('instagram_feed')){
					the_field('instagram_feed');
				}

				}
			}
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
