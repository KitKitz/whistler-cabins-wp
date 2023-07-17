<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Whistler_Cabins
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'whistler-cabins' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
			<p>
				<?php
				esc_html_e( 'Sorry, we can&rsquo;t find the page you&rsquo;re looking for. Please use the links below to access popular pages, or heading to our', 'whistler-cabins' );
				echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'home page', 'whistler-cabins' ) . '</a>.';
				?>
			</p>
				<section class="products-categories">
					<h2 class="products-categories-title"><?php esc_html_e( 'Cabin Categories', 'whistler-cabins' ); ?></h2>
					<?php
					$cabins_categories = get_terms(
						array(
							'taxonomy' => 'product_cat',
							'orderby' => 'count',
							'order' => 'DESC',
							'number' => 10,
							'hide_empty' => true,
						)
					);
	
					if (!empty($cabins_categories) && !is_wp_error($cabins_categories)) : ?>
						<ul>
							<?php foreach ($cabins_categories as $category) : ?>
								<?php if ($category->term_id === 18) continue; ?>
								<li>
									<a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</section>
				<!-- .product categories -->

				<section class="widget widget_categories">
					<h2 class="widget-title"><?php esc_html_e( 'Popular Activities', 'whistler-cabins' ); ?></h2>
					<ul>
						<?php
						wp_list_categories(
							array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							)
						);
						?>
					</ul>
				</section>
				<!-- .widget -->
			</div><!-- .page-content -->
		</div><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
