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
			if (function_exists('get_field') && get_field( 'footer_acknowledgement', 'option' )) :
				?>
				<p><?php the_field( 'footer_acknowledgement', 'option' )?></p>
				<?php
			endif ?>

		</section>

		<section class="business-info">
		<?php
			if (function_exists('get_field')) :
				
				if (get_field( 'business_address', 'option' )) : ?>
					<address><?php the_field( 'business_address', 'option' )?></address>
					<?php
				endif; 

				if (get_field( 'business_phone', 'option' )) : ?>
					<a href="<?php the_field( 'business_phone', 'option' )?>"><?php the_field( 'business_phone', 'option' )?></a>
					<?php
				endif;

				if (get_field( 'business_phone', 'option' )) : ?>
					<a href="mailto:<?php the_field( 'business_email', 'option')?>"><?php the_field( 'business_email', 'option' )?></p>
					<?php
				endif;

			endif ?>

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
