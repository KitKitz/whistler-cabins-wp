<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Whistler_Cabins
 */

?>

	<footer id="colophon" class="site-footer">

		<section class="site-branding">
			<?php	the_custom_logo(); ?>
			<h2><?php bloginfo( 'name' ); ?> </h2>
			<?php 
			if( function_exists( 'get_field' ) && get_field( 'acknowledgement_content' )) : ?>
				<p> <?php the_field( 'acknowledgement_content' ) ?> <p>
			<?php
			endif;
			?>
		</section>

		<nav id="site-navigation" class="footer-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
				)
			);
			?>
		</nav>

	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
