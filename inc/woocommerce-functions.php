<?php
/**
 * Editing WooCommerce Shop Page 
 * 
 */ 

function whistler_cabins_shop_init(){

	function whistler_cabins_shop_giftcard_section(){
		$giftCardProductId = 54;
		$product = wc_get_product($giftCardProductId);
		$permalink = $product->get_permalink();
		?>
		<section class="gift-card-banner">
		<?php
			if(function_exists('get_field')){
				if(get_field('gc_section_title', 25)){
					?><h1><?php the_field('gc_section_title', 25);?></h1><?php
				}
				if(get_field('gc_section_content' , 25)){
					?><p><?php the_field('gc_section_content' , 25);?></p><?php
				}
				if(get_field('gc_section_button' , 25)){
					?><a href="<?php echo $permalink?>"><?php the_field('gc_section_button', 25)?></a><?php
				}
			}
		?>
		</section>
		<?php
	}
	add_action(
		'woocommerce_after_shop_loop',
		'whistler_cabins_shop_giftcard_section',
		9
	);
	function whistler_cabins_sidebar(){
		get_sidebar();
	}
	add_action(
		'woocommerce_before_shop_loop',
		'whistler_cabins_sidebar',
		31
	);

	function whistler_cabins_category($category_ids) {
		if (is_shop() || is_front_page()) {
			global $product;
			$product_categories = wp_get_post_terms($product->get_id(), 'product_cat', array('fields' => 'ids'));
	
			// Check if any of the product's categories match the specified category IDs
			$matches = array_intersect($product_categories, $category_ids);
	
			if (!empty($matches)) {
				// Loop through the matched categories and display them
				foreach ($matches as $cat_id) {
					$category = get_term($cat_id, 'product_cat');
					?><p><a href="<?php echo get_term_link($category)?>"><?php echo $category->name; ?></a></p><?php
				}
			}
		}
	}
	
	add_action('woocommerce_after_shop_loop_item_title', 
				function() {
					whistler_cabins_category(array(25, 27, 44, 45, 46, 47));
				}, 
				11
	);

	add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_add_to_cart_button_text_archives' );  
	function woocommerce_add_to_cart_button_text_archives() {
    return __( 'View Cabin', 'woocommerce' );
	}

}
add_action('init', 'whistler_cabins_shop_init');