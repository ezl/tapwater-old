<?php 

/**
 * education-institute functions and definitions
 * @package education-institute
 */

if( ! function_exists( 'education_institute_theme_setup' ) ) {

	function education_institute_theme_setup() {
		
	    load_theme_textdomain( 'education-institute', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		
		// Add default title support
		add_theme_support( 'title-tag' ); 		

		// Add default logo support		
        add_theme_support( 'custom-logo' );	

        // To use additional css
 	    add_editor_style( 'css/editor-style.css' );		

		add_theme_support('post-thumbnails');
		
		
		$defaults = array(
			'default-image'          => get_template_directory_uri() .'/assets/images/header.jpg',
			'width'                  => 1920,
			'height'                 => 540,
			'uploads'                => true,
			'default-text-color'     => "d8d2d2",
            'wp-head-callback'       => 'education_institute_header_style',

			);
		add_theme_support( 'custom-header', $defaults );

		/**
		* Set the content width in pixels, based on the theme's design and stylesheet.
		*/
		$GLOBALS['content_width'] = apply_filters( 'education-institute_content_width', 980 );
		
		// Add theme support for Semantic Markup
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
		 
		 add_theme_support( 'customize-selective-refresh-widgets' );
		 
		// add excerpt support for pages
		add_post_type_support( 'page', 'excerpt' );
		
		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	   
		// Menus
		//add_theme_support( 'menus' );

        register_nav_menus(array(
       'primary' => esc_html__('primary Menu', 'education-institute')
       ));		

	}
	add_action( 'after_setup_theme', 'education_institute_theme_setup' );
}


function education_institute_header_style()
{
		$education_institute_header_text_color = get_header_textcolor();

	?>
		<style type="text/css">
			<?php
				if ( get_header_image() ) :
			?>

			.site-title,.site-description
			 {
			color: #<?php echo esc_attr($education_institute_header_text_color); ?>;
			
			  }
			.banner-area
			  {
				background-image:url('<?php header_image(); ?>');
			  }
		
			<?php endif; ?>	
		</style>
	<?php

}


/**
 * Load welcome page file
 */
require get_template_directory() . '/inc/welcome/welcome.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/custom-edition/upgrade/class-customize.php';


// Register Nav Walker class_alias
require get_template_directory() . '/class-wp-bootstrap-navwalker.php';
require get_template_directory(). '/inc/customizer.php';
require get_template_directory(). '/inc/breadcrumbs.php';

  
if( ! function_exists( 'education_hubs_enqueue_styles' ) ) {
	function education_hubs_enqueue_styles() {
		
	// Bootstrap CSS 
	wp_enqueue_style('education-institute-font', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Roboto:300,400,500,700');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
    wp_enqueue_style('slicknav', get_template_directory_uri() . '/assets/css/slicknav.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
	wp_enqueue_style('education-institute-color-css', get_template_directory_uri() . '/assets/css/color.css');
	wp_enqueue_style('education-institute-style', get_stylesheet_uri() );
	wp_enqueue_style('education-institute-responsive', get_template_directory_uri() . '/assets/css/responsive.css');
	
	}
	add_action( 'wp_enqueue_scripts', 'education_hubs_enqueue_styles' );
}

/**
 * Enqueue JS scripts
 */

if( ! function_exists( 'education_institute_enqueue_scripts' ) ) {
	function education_institute_enqueue_scripts() {
   
	    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '', true);
	    wp_enqueue_script('slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.js', array(), '', true);

		wp_enqueue_script('scrollup',     get_template_directory_uri() . '/assets/js/scrollup.js', array(), '', true);
			
		wp_enqueue_script('education-institute-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '', true);
		wp_enqueue_script( 'education-institute-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), true );
		
		
	}
	add_action( 'wp_enqueue_scripts', 'education_institute_enqueue_scripts' );
}

 function education_institute_cat_count_span($links) {
        $links = str_replace('</a> ',' <span class="float-right">', $links);
        $links = str_replace('', '</span></a>', $links);
        return $links;
    }
    add_filter('wp_list_categories', 'education_institute_cat_count_span');
  
    function education_institute_style_the_archive_count($links) {
        $links = str_replace('</a>&nbsp;', '<span class="float-right">', $links);
        $links = str_replace('', '</span></a>', $links);
        return $links;
    }

    add_filter('get_archives_link', 'education_institute_style_the_archive_count');

/**
 * Register sidebars for education-institute
*/

function education_institute_sidebars() {

	// Blog Sidebar
	
	register_sidebar(array(
		'name' => esc_html__( 'Blog Sidebar', "education-institute"),
		'id' => 'blog-sidebar',
		'description' => esc_html__( 'Sidebar on the blog layout.', "education-institute"),
		'before_widget' => '<div id="%1$s" class="course-info-side %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title-one"><h3>',
		'after_title' => '</h3></div>',
	));
  	

	// Footer Sidebar
	
	register_sidebar(array(
		'name' => esc_html__( 'Footer Widget Area', "education-institute"),
		'id' => 'education-institute-footer-widget-area',
		'description' => esc_html__( 'The footer widget area', "education-institute"),
		'before_widget' => '<div class="%2$s footer-widget col-md-4 col-sm-6 col-xs-12">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-title"> <span class="theme-text">',
		'after_title' => '</span></h3><span class="title-sep left-sep"></span>',
	));	
	
	
		
}

add_action( 'widgets_init', 'education_institute_sidebars' );
if ( ! function_exists( 'wp_body_open' ) ) {
function wp_body_open() {
		do_action( 'wp_body_open' );
}
}