<?php
/**
 * Theme Info Page
 * Special thanks to the Consulting theme by ThinkUpThemes for this info page to be used as a foundation.
 * @package Openness
 */
 
function openness_info() {    


	// About page instance
	// Get theme data
	$theme_data     = wp_get_theme();

	// Get name of parent theme

		$theme_name    = trim( ucwords( str_replace( ' (Lite)', '', $theme_data->get( 'Name' ) ) ) );
		$theme_slug    = trim( strtolower( str_replace( ' (Lite)', '-lite', $theme_data->get( 'Name' ) ) ) );
		$theme_version = $theme_data->get( 'Version' );

	$config = array(
		// translators: %1$s: menu title under appearance
		'menu_name'             => sprintf( esc_html__( 'About %1$s', 'openness' ), ucfirst( $theme_name ) ),
		// translators: %1$s: page name 
		'page_name'             => sprintf( esc_html__( 'About %1$s', 'openness' ), ucfirst( $theme_name ) ),
		// translators: %1$s: welcome title 
		'welcome_title'         => sprintf( esc_html__( 'Welcome to %1$s - v', 'openness' ), ucfirst( $theme_name ) ),
		// translators: %1$s: welcome content 
		'welcome_content'       => sprintf( esc_html__(  '%1$s is a flexible blog theme that is made for bloggers who love to use images. It features a visual style that is more refined, unlimited colours, a couple of blog layouts that include a grid concept (more layouts available in the Pro version), RTL support, the ability to show or hide various page elements, and more.', 'openness' ), ucfirst( $theme_name ) ),
		
		/**
		 * Tabs array.
		 *
		 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
		 * the will be the name of the function which will be used to render the tab content.
		 */	
		'upgrade'             => array(
			'upgrade_url'     => 'https://www.bloggingthemestyles.com/wordpress-themes/openness-pro/',
			'price_discount'  => __( 'Upgrade and Save 5%', 'openness' ),
			'price_normal'	  => __( 'Use coupon at checkout.', 'openness' ),
			'coupon'	      =>  __( 'SAVEFIVE', 'openness' ),
			'button'	      => __( 'Get the Pro', 'openness' ),
		),
		 
		'tabs'                 => array(
			'getting_started'  => esc_html__( 'Getting Started', 'openness' ),
			'support_content'  => esc_html__( 'Support', 'openness' ),
			'theme_review'  => esc_html__( 'Reviews', 'openness' ),
			'changelog'           => esc_html__( 'Changelog', 'openness' ),
			'free_pro'         => esc_html__( 'Free VS PRO', 'openness' ),
		),
		// Getting started tab
		'getting_started' => array(
			'first' => array (
				'title'               => esc_html__( 'Setup Documentation', 'openness' ),
				'text'                => sprintf( esc_html__( 'To help you get started with the initial setup of this theme and to learn about the various features, you can check out our detailed setup documentation.', 'openness' ) ),
				// translators: %1$s: theme name 
				'button_label'        => sprintf( esc_html__( 'View %1$s Tutorials', 'openness' ), ucfirst( $theme_name ) ),
				'button_link'         => esc_url( '//www.bloggingthemestyles.com/documentation/' ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),
			'second' => array(
				'title'               => esc_html__( 'Go to Customizer', 'openness' ),
				'text'                => esc_html__( 'Using the WordPress Customizer, you can easily customize every aspect of the theme.', 'openness' ),
				'button_label'        => esc_html__( 'Go to Customizer', 'openness' ),
				'button_link'         => esc_url( admin_url( 'customize.php' ) ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),
			
			'third' => array(
				'title'               => esc_html__( 'Using a Child Theme', 'openness' ),
				'text'                => sprintf( esc_html__( 'If you plan to customize this theme, I recommend looking into using a child theme. To learn more about child themes and why it\'s important to use one, check out the WordPress documentation.', 'openness' ) ),
				'button_label'        => sprintf( esc_html__( 'Child Themes', 'openness' ), ucfirst( $theme_name ) ),
				'button_link'         => esc_url( '//developer.wordpress.org/themes/advanced-topics/child-themes/' ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),		
		),

		// Changelog content tab.
		'changelog'      => array(
			'first' => array (				
				'title'        => esc_html__( 'Changelog', 'openness' ),
				'text'         => esc_html__( 'I generally recommend you always read the CHANGELOG before updating so that you can see what was fixed, changed, deleted, or added to the theme.', 'openness' ),	
				'button_label' => '',
				'button_link'  => '',
				'is_button'    => false,
				'is_new_tab'   => false,				
				),
		),			
		// Support content tab.
		'support_content'      => array(
			'first' => array (
				'title'        => esc_html__( 'Free Support', 'openness' ),
				'icon'         => 'dashicons dashicons-sos',
				'text'         => esc_html__( 'If you experience any problems, please post your questions to support and we will be more than happy to help you out.', 'openness' ),
				'button_label' => esc_html__( 'Get Free Support', 'openness' ),
				'button_link'  => esc_url( '//www.bloggingthemestyles.com/support' ),
				'is_button'    => true,
				'is_new_tab'   => true,
			),
			'second' => array(
				'title'        => esc_html__( 'Common Problems', 'openness' ),
				'icon'         => 'dashicons dashicons-editor-help',
				'text'         => esc_html__( 'For quick answers to the most common problems, you can check out the tutorials which can provide instant solutions and answers.', 'openness' ),
				'button_label' => sprintf( esc_html__( 'Get Answers', 'openness' ) ),
				'button_link'  => '//www.bloggingthemestyles.com/common-problems',
				'is_button'    => true,
				'is_new_tab'   => true,
			),

		),
		// Review content tab.
		'theme_review'      => array(
			'first' => array (
				'title'        => esc_html__( 'Theme Review', 'openness' ),
				'icon'         => 'dashicons dashicons-thumbs-up',
				'text'         => esc_html__( 'We would love to request a 5-star rating from you! If so, please visit the theme page and add your review and your star rating. If you have suggestions to help improve this theme, please let us know. If you experience problems, request support and we will be happy to help you out.', 'openness' ),
				'button_label' => esc_html__( 'Add Your Star Rating', 'openness' ),
				'button_link'  => esc_url( '//wordpress.org/support/theme/openness/reviews/' ),
				'is_button'    => true,
				'is_new_tab'   => true,
			),
		),		
		// Free vs pro array.
		'free_pro'                => array(
			'free_theme_name'     => ucfirst( $theme_name ) . ' (free)',
			'pro_theme_name'      => esc_html__('Openness Pro','openness' ),
			'pro_theme_link'      => '//www.bloggingthemestyles.com/wordpress-themes/openness-pro/',
			'get_pro_theme_label' => sprintf( esc_html__( 'Get Openness Pro', 'openness' ) ),
			'features'            => array(
				array(
					'title'            => esc_html__( 'Mobile Friendly', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Unlimited Colours', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				
				array(
					'title'            => esc_html__( 'Header Image', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Background Image', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Built-In Social Menu', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Show or Hide Elements', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Custom Error Page', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				
				array(
					'title'            => esc_html__( 'Blog Styles', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '2',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '4',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Sidebar Positions', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '5',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '14',
					'hidden'           => '',
				),

				array(
					'title'            => esc_html__( 'Recent Posts Widget with Thumbnails', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				array(
					'title'            => esc_html__( 'Blog Thumbnail Creation', 'openness' ),
					'description'      => esc_html__('Automatically have post featured images cropped when uploading.', 'openness'),
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				array(
					'title'            => esc_html__( 'Theme Options', 'openness' ),
					'description'      => '',
					'is_in_lite'       => '',
					'is_in_lite_text'  => 'Basic',
					'is_in_pro'        => '',
					'is_in_pro_text'   => 'Premium',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Support', 'openness' ),
					'description'      => '',
					'is_in_lite'       => '',
					'is_in_lite_text'  => 'Basic',
					'is_in_pro'        => '',
					'is_in_pro_text'   => 'Premium',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( '1 Click Demo Content Import', 'openness' ),
					'description'      => esc_html__('If you want to start fresh with a site that looks like the demo, you get a 1-click-demo import feature.', 'openness'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
				array(
					'title'            => esc_html__( 'Related Posts with Thumbnails', 'openness' ),
					'description'      => '',
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
							
				array(
					'title'            => esc_html__( 'Sidebar Overlay with Adjustable Transparency', 'openness' ),
					'description'      => esc_html__('You get a dark overlay on top of your sidebar background which you can darken or lighten with your sidebar content on top.', 'openness'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				

				array(
					'title'            => esc_html__( 'Custom Blog Title &amp; Introduction', 'openness' ),
					'description'      => esc_html__('WordPress does not have this, but we have added a customizable blog title and intro option.', 'openness'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				
				
				array(
					'title'            => esc_html__( 'Author Info Widget', 'openness' ),
					'description'      => esc_html__('We included an author widget with information, status, and with social icon links.', 'openness'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Custom Styled MailChimp Widget Support', 'openness' ),
					'description'      => esc_html__('Although optional, we included bonus theme styling for a very popular mailchimp plugin.', 'openness'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
				array(
					'title'            => esc_html__( 'Add Google Fonts', 'openness' ),
					'description'      => esc_html__('Add up to 2 more Google Fonts.', 'openness'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Typography Options', 'openness' ),
					'description'      => esc_html__('Includes basic settings for your main text and headings, and a few more items.', 'openness'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),						
				array(
					'title'            => esc_html__( 'Custom Styled Archive Titles', 'openness' ),
					'description'      => esc_html__('We customized the style of archive titles for tags, categories, etc.', 'openness'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
		
				
			),
		),
	);
	openness_info_page::init( $config );

}

add_action('after_setup_theme', 'openness_info');

?>