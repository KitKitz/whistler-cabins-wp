<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Whistler_Cabins
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || ! is_active_sidebar( 'sidebar-2' )) {
	return;
}

?>


<aside id="secondary" class="widget-area">

	<?php 
	if(is_home() || is_archive() && !is_shop() && !is_tax('product_cat')){
		dynamic_sidebar( 'sidebar-1' );
	}else if (is_shop() || is_tax('product_cat') ){
		dynamic_sidebar( 'sidebar-2' ); 
	} ?>

</aside><!-- #secondary -->
