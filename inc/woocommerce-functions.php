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

	function whistler_cabins_category() {
		if (is_shop() || is_front_page()) {
			if(function_exists('get_field')){
				if (get_field('cabin_view')){
					?><p><?php the_field('cabin_view');?></p><?php
				}
				if (get_field('cabin_sleeps')){
					?><p><?php the_field('cabin_sleeps');?></p><?php
				}
			}
		}
	}
	
	add_action('woocommerce_after_shop_loop_item_title', 
				'whistler_cabins_category', 
				11
	);

	add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_add_to_cart_button_text_archives' );  
	function woocommerce_add_to_cart_button_text_archives() {
    return __( 'View Cabin', 'woocommerce' );
	}


	//Single Cabin functions

		//display testimonials
		function whistler_cabins_testimonial() {
			get_template_part( 'template-parts/testimonial' );
		}

		add_action( 'woocommerce_after_single_product_summary', 'whistler_cabins_testimonial', 15 );

		//display gallery
		function whistler_cabins_gallery() {
			if (function_exists('get_field')){
				$images = get_field( 'gallery' );

				if($images){
					foreach ( $images as $image ) :
						$image_id      = $image['ID'];
						$image_src     = $image['url'];
						$image_caption = $image['caption'];
						?>
							<a href="<?php echo esc_url( $image_src ); ?>" title="<?php echo esc_html( $image_caption ); ?>" class="gallery">
								<?php echo wp_get_attachment_image( $image_id, 'large' ); ?>
							</a>
							<?php
					endforeach;
				}

			}
		}

		add_action( 'woocommerce_single_product_summary', 'whistler_cabins_gallery', 45 );

		//remove category 
		function whistler_cabins_remove_product_category() {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}
		add_action( 'woocommerce_single_product_summary', 'whistler_cabins_remove_product_category' );
		
		//customize tags display
		function whistler_cabins_customize_product_tags() {
			global $product;
		
			$tags = $product->get_tag_ids();
		
			if ( $tags ) {
				?>
				<section class="amenities">
					<h2>Amenities</h2>
						<ul>
							<?php
							foreach ( $tags as $tag_id ) {
								$tag = get_term_by( 'id', $tag_id, 'product_tag' );
					
								if ( $tag ) {
									echo '<li>' . $tag->name . '</li>';
								}
							}
							?>
						</ul>
				</section>
				<?php
			}
		}
		add_action( 'woocommerce_single_product_summary', 'whistler_cabins_customize_product_tags', 40 );

		//move product description before the tags
		function whistler_cabins_move_description() {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 35 );
		}
		add_action( 'woocommerce_single_product_summary', 'whistler_cabins_move_description');
		

}
add_action('init', 'whistler_cabins_shop_init');