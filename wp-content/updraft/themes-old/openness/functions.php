<?php
/**
 * Openness functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 * @package Openness
 */

//Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 925;
}

// Openness only works in WordPress 4.1 or later.
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 * Note that this function is hooked into the after_setup_theme hook, which runs before the init hook. The init hook is too late for some features, such as indicating support for post thumbnails.
 */
 if ( ! function_exists( 'openness_setup' ) ) :
function openness_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/openness
	 * If you're building a theme based on openness, use a find and replace to change 'openness' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'openness', get_template_directory() . '/languages' );	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a hard-coded <title> tag in the document head, and expect WordPress to provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

		// create featured images for the default blog style
		if( esc_attr(get_theme_mod( 'openness_centered_thumbnails', false ) ) ) :
			add_image_size( 'openness-centered', 925, 535, true );
		endif;	
		
		// create featured images for the cards blog style
		if( esc_attr(get_theme_mod( 'openness_card_thumbnails', false ) ) ) :
			add_image_size( 'openness-cards', 700, 500, true );
		endif;	
		
		// create recent posts thumbnails
		add_image_size( 'openness-recent', 80, 80, true );
		
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'openness' ),
		'social'  => __( 'Social Links Menu', 'openness' ),
		'footer'  => __( 'Footer Menu', 'openness' ),
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form', 
		'comment-list', 
		'gallery', 
		'caption'
	) );

	// Enable support for custom logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );


	add_theme_support( 'custom-background', apply_filters( 'openness_custom_background_args', array(
		'default-color'      => 'ffffff',
		'default-attachment' => 'fixed',
	) ) );

	// This theme styles the visual editor to resemble the theme style, specifically font, colors, icons, and column width.
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', openness_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // openness_setup
add_action( 'after_setup_theme', 'openness_setup' );

/**
 * Register Google fonts for Openness.
 * @return string Google fonts URL for the theme.
 */
 if ( ! function_exists( 'openness_fonts_url' ) ) :
function openness_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'openness' ) ) {
		$fonts[] = 'Noto Sans:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'openness' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
*/
function openness_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'openness_javascript_detection', 0 );

	
// Custom excerpt size
function openness_custom_excerpt_length( $length ) { 
	$openness_excerpt_size = esc_attr(get_theme_mod( 'openness_excerpt_size', '35' ));
	if ( is_admin() ) :
		return 55;		
	else: 	
		return $openness_excerpt_size;
	endif;
	}
add_filter( 'excerpt_length', 'openness_custom_excerpt_length', 999 );

	
/*
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Read More' link.
 * Also include a setting to disable the read-more on excerpts
 */
		 
	function openness_excerpt_more( $link ) { 
		$openness_show_excerpt_readmore = esc_attr(get_theme_mod( 'openness_show_excerpt_readmore', true ));
			if ( is_admin() ) {
				return $link;
			}
			$link = sprintf( '<p class="more-link-wrapper"><a href="%1$s" class="more-link">%2$s</a></p>',
				esc_url( get_permalink( get_the_ID() ) ),
				/* translators: %s: Name of current post */
				sprintf( __( 'Continue Reading<span class="screen-reader-text"> "%s"</span>', 'openness' ), get_the_title( get_the_ID() ) )
			);
			if ( $openness_show_excerpt_readmore == true) :
				return '&hellip;' . $link;
			endif;
			if ( $openness_show_excerpt_readmore == false) : 
				return '&hellip;';
			endif;
		}
		add_filter( 'excerpt_more', 'openness_excerpt_more' );
		


//	Move the Continue Reading link outside of the paragraph
	if ( ! function_exists( 'openness_move_more_link' ) ) :
		function openness_move_more_link($link) {
				$link = '<p class="more-link-wrapper">'.$link.'</p>';
				return $link;
			}
		add_filter('the_content_more_link', 'openness_move_more_link');
	endif;	
	


// Enqueue scripts and styles.

function openness_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'openness-fonts', openness_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'openness-style', get_stylesheet_uri() );
	
	// Load skip-link-focus-fix
	wp_enqueue_script( 'openness-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'openness-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'openness-script', 'OpennessscreenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'openness' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'openness' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'openness_scripts' );

// Add preconnect for Google Fonts.
function openness_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'openness-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'openness_resource_hints', 10, 2 );


// Display descriptions in main navigation.
function openness_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'openness_nav_description', 10, 4 );

// Add a `screen-reader-text` class to the search form's submit button.
function openness_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'openness_search_form_modify' );

// recent posts
require get_template_directory() . '/inc/class-openness-recent-posts-widget.php';


// Include better comments file
require get_template_directory() .'/inc/comment-style.php';

// Implement the Custom Header feature.
require get_parent_theme_file_path( '/inc/custom-header.php' );

// Custom template tags for this theme.
require get_parent_theme_file_path( '/inc/template-tags.php' );

// Customizer additions.
require get_parent_theme_file_path( '/inc/customizer.php' );

// Inline Styles.
require get_parent_theme_file_path( '/inc/inline-styles.php' );

// Theme Info.
require get_parent_theme_file_path( '/inc/theme-info/openness-info-class-about.php' );
require get_template_directory() . '/inc/theme-info/openness-info.php';

// Theme sidebars.
require get_parent_theme_file_path( '/inc/sidebars.php' );
