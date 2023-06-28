<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Whistler_Cabins
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

?>


<aside id="secondary" class="widget-area">

	<?php if(is_home() || is_archive()){
		dynamic_sidebar( 'sidebar-1' );
	} ?>

</aside><!-- #secondary -->
