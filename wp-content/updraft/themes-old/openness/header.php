<?php
/**
 * The template for displaying the header
 * Displays all of the head element and everything up until the "site-content" div.
 * @package Openness
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'openness' ); ?></a>

	<div id="sidebar" class="sidebar">
		<header id="masthead" class="site-header">
			<div class="site-branding">
				<?php
					openness_the_custom_logo();

					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_html($description); ?></p>
					<?php endif;
				?>
				<button class="secondary-toggle"><?php esc_html_e( 'Menu and widgets', 'openness' ); ?></button>
			</div><!-- .site-branding -->
		</header><!-- .site-header -->

		<?php get_template_part( 'template-parts/sidebars/sidebar' ); ?>
	</div><!-- .sidebar -->

	<div id="content" class="site-content">
