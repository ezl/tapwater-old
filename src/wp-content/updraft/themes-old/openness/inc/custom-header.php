<?php
/**
 * Custom Header functionality for Openness
 * @package Openness
 */

/**
 * Set up the WordPress core custom header feature.
 * @uses openness_header_style()
 */
function openness_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'openness_custom_header_args', array(
		'default-text-color'     => 'ffffff',
		'width'                  => 954,
		'height'                 => 1300,
		'wp-head-callback'       => 'openness_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'openness_custom_header_setup' );


if ( ! function_exists( 'openness_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 * @see openness_custom_header_setup()
 */
function openness_header_style() {
	$header_image = get_header_image();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && display_header_text() ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css" id="openness-header-css">
	<?php
		// Has a Custom Header been added?
		if ( ! empty( $header_image ) ) :
	?>
		.site-header {

			/*
			 * No shorthand so the Customizer can override individual properties.
			 * @see https://core.trac.wordpress.org/ticket/31460
			 */
			background-image: url(<?php header_image(); ?>);
			background-repeat: no-repeat;
			background-position: 50% 50%;
			-webkit-background-size: cover;
			-moz-background-size:    cover;
			-o-background-size:      cover;
			background-size:         cover;
		}

		@media screen and (min-width: 59.6875em) {
			body:before {

				/*
				 * No shorthand so the Customizer can override individual properties.
				 * @see https://core.trac.wordpress.org/ticket/31460
				 */
				background-image: url(<?php header_image(); ?>);
				background-repeat: no-repeat;
				background-position: 100% 50%;
				-webkit-background-size: cover;
				-moz-background-size:    cover;
				-o-background-size:      cover;
				background-size:         cover;
				border-right: 0;
			}

			.site-header {
				background: transparent;
			}
		}
	<?php
		endif;
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // openness_header_style
