<?php
/**
 * The template for displaying 404 pages (not found)
 * @package Openness
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

	<section class="error not-found">
		<h2 class="error-title"><?php esc_html_e( 'Error 404', 'openness' ); ?></h2>
		<h3 class="error-subtitle"><?php esc_html_e( 'Unfortunately this Page is Missing', 'openness' ); ?></h3>
		<p class="error-message"><?php esc_html_e( 'The page you were looking for cannot be found, it may have been moved or no longer exists. You may want to navigate back to the homepage.', 'openness' ); ?></p>
		<p class="error-search"><?php get_search_form(); ?></p>
		<p><a class="more-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html_e( 'or Go Back Home', 'openness' ); ?></p>
	</section>		

		</main>
	</div>

<?php get_footer(); ?>
