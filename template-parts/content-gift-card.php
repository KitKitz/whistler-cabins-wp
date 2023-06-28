<?php
/**
 * Template part for displaying gift card section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Whistler_Cabins
 */

?>
<?php
$giftCardProductId = 54;
$product = wc_get_product($giftCardProductId);
$permalink = $product->get_permalink();
?>
	<section class="gift-card-banner">
		<?php
			if(function_exists('get_field')){
				if(get_field('gc_section_title')){
					?><h1><?php the_field('gc_section_title');?></h1><?php
				}
				if(get_field('gc_section_content')){
					?><p><?php the_field('gc_section_content');?></p><?php
				}
				if(get_field('gc_section_button')){
					?><a href="<?php echo $permalink?>"><?php the_field('gc_section_button')?></a><?php
				}
			}
		?>
	</section>
