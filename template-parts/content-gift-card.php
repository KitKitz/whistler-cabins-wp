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
if(is_shop() || is_front_page()){
	$giftCardProductId = 54;
	$product = wc_get_product($giftCardProductId);
	$permalink = $product->get_permalink();
?>
	<section class="gift-card-banner">
		<?php
			if(function_exists('get_field')){
				if(get_field('gc_section_title', 'option' )){
					?><h1><?php the_field('gc_section_title', 'option' );?></h1><?php
				}
				if(get_field('gc_section_content', 'option' )){
					?><p><?php the_field('gc_section_content', 'option' );?></p><?php
				}
				if(get_field('gc_section_button', 'option' )){
					?><a href="<?php echo $permalink?>"><?php the_field('gc_section_button', 'option' ) ?></a><?php
				}
			}
		?>
	</section>
<?php
}

