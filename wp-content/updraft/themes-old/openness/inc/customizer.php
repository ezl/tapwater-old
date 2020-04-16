<?php
/**
 * Openness Customizer functionality
 * @package Openness
 */

 /**
 * Control type.
 * For Upsell content in the customizer
 */
if ( ! class_exists( 'Openness_Customize_Static_Text_Control' ) ){
	if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
		class Openness_Customize_Static_Text_Control extends WP_Customize_Control {
		public $type = 'static-text';
		public function esc_html__construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
		}
		protected function render_content() {
			if ( ! empty( $this->label ) ) :
				?><span class="openness-customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
			endif;
			if ( ! empty( $this->description ) ) :
				?><div class="openness-description openness-customize-control-description"><?php

				if( is_array( $this->description ) ) {
					echo '<p>' . implode( '</p><p>', wp_kses_post( $this->description )) . '</p>';
					
				} else {
					echo wp_kses_post( $this->description );
				}
				?>
							
			<h1><?php esc_html_e('Openness Pro', 'openness') ?></h1>
			
			<p><?php esc_html_e('If you decide to upgrade to the pro version of this theme, use this discount code on checkout.','openness'); ?></p>	
			<div id="promotion-header"><p class="main-title"><?php esc_html_e('Upgrade to Pro (Save $5)', 'openness') ?><br><?php esc_html_e('Use Code:', 'openness') ?> <strong><?php esc_html_e('SAVEFIVE', 'openness') ?></strong></p>
			<p><a href="https://www.bloggingthemestyles.com/wordpress-themes/openness-pro/" target="_blank" class="button button-primary"><?php esc_html_e('Get the Pro - Save $5', 'openness') ?></a></p></div>

			<p style="font-weight: 700;"><?php esc_html_e('Pro Features:', 'openness') ?></p>
			<ul>
				<li><?php esc_html_e('&bull; 4 Blog Styles', 'openness')?></li>
				<li><?php esc_html_e('&bull; 14 Dynamic Sidebar Positions', 'openness')?></li>
				<li><?php esc_html_e('&bull; An Author Info Widget', 'openness')?></li>
				<li><?php esc_html_e('&bull; Related Posts with Thumbnails', 'openness')?></li>
				<li><?php esc_html_e('&bull; Custom MailChimp Styles for an Optional Plugin', 'openness')?></li>
				<li><?php esc_html_e('&bull; 1 Click Demo Content Import', 'openness')?></li>
				<li><?php esc_html_e('&bull; Add More Google Fonts', 'openness')?></li>
				<li><?php esc_html_e('&bull; Typography Options', 'openness')?></li>
				<li><?php esc_html_e('&bull; Sidebar Background Overlay', 'openness')?></li>
				<li><?php esc_html_e('&bull; Blog Home Page with Customizable Title and Intro', 'openness')?></li>
				<li><?php esc_html_e('&bull; Premium Support', 'openness')?></li>
			</ul>
			
					
			<?php
			endif;
		}
	}
} 
/**
 * Add postMessage support for site title and description for the Customizer.
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function openness_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'openness_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'openness_customize_partial_blogdescription',
		) );
	}

	// Remove the core header textcolor control, as it shares the sidebar text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add an additional description to the header image section.
	$wp_customize->get_section( 'header_image' )->description = __( 'Applied to the header on small screens and the sidebar on wide screens.', 'openness' );
	
// SECTION - UPGRADE
    $wp_customize->add_section( 'openness_upgrade', array(
        'title'       => esc_html__( 'Upgrade to Pro', 'openness' ),
        'priority'    => 0
    ) );
	
		$wp_customize->add_setting( 'openness_upgrade_pro', array(
			'default' => '',
			'sanitize_callback' => '__return_false'
		) );
		
		$wp_customize->add_control( new Openness_Customize_Static_Text_Control( $wp_customize, 'openness_upgrade_pro', array(
			'label'	=> esc_html__('Get The Pro Version:','openness'),
			'section'	=> 'openness_upgrade',
			'description' => array('')
		) ) );	
		
// SECTION - THEME OPTIONS
	$wp_customize->add_section( 'openness_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'openness' ),
		'priority' => 20, 
	) );	
	
	// Setting group for blog style  
	$wp_customize->add_setting( 'openness_blog_style', array(
		'default' => 'blog-standard',
		'sanitize_callback' => 'openness_sanitize_select',
	) );  
	$wp_customize->add_control( 'openness_blog_style', array(
		  'type' => 'radio',
		  'label' => esc_html__( 'Blog Style', 'openness' ),
		  'section' => 'openness_theme_options',
		  'choices' => array(	
				'blog-standard' => esc_html__( 'Default Style', 'openness' ),	  
				'blog-card' => esc_html__( 'Card Style', 'openness' ),
		) ) );	

	 // Use excerpts for blog posts
	  $wp_customize->add_setting( 'openness_use_excerpt',  array(
		  'default' => false,
		  'sanitize_callback' => 'openness_sanitize_checkbox',
		) );  
	  $wp_customize->add_control( 'openness_use_excerpt', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Use Excerpts', 'openness' ),
		'description' => esc_html__( 'Use excerpts for your blog post summaries or uncheck the box to use the standard Read More tag. NOTE: Some blog styles only use excerpts.', 'openness' ),
		'section'  => 'openness_theme_options',
	  ) );
	  
    // Excerpt size
    $wp_customize->add_setting( 'openness_excerpt_size',  array(
            'sanitize_callback' => 'absint',
            'default'           => '55',
        ) );
    $wp_customize->add_control( 'openness_excerpt_size', array(
        'type'        => 'number',
        'section'     => 'openness_theme_options',
        'label'       => esc_html__('Excerpt Size', 'openness'),
		'description' => esc_html__('You can change the size of your blog summary excerpts with increments of 5 words.', 'openness'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );	

	// Enable blog card thumbnails
	$wp_customize->add_setting( 'openness_centered_thumbnails',	array(
		'default' => false,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_centered_thumbnails', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Enable Blog Centered Thumbnail Creation', 'openness' ),
		'description' => esc_html__( 'When enabled, a custom thumbnail will be created for the Centered layout. Images will be 700x535 pixels.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );	
	
	// Enable blog card thumbnails
	$wp_customize->add_setting( 'openness_card_thumbnails',	array(
		'default' => false,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_card_thumbnails', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Enable Blog Card Thumbnail Creation', 'openness' ),
		'description' => esc_html__( 'When enabled, a custom thumbnail will be created for the Cards layout. Images will be 500x400 pixels.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );	

	// Show read more on excerpts
	$wp_customize->add_setting( 'openness_show_excerpt_readmore',	array(
		'default' => true,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_show_excerpt_readmore', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Continue Reading Link', 'openness' ),
		'description' => esc_html__( 'This lets you show the blog excerpt Continue Reading link on blog related posts.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );	
	
	// Show post featured label
	$wp_customize->add_setting( 'openness_show_featured_label',	array(
		'default' => true,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_show_featured_label', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Featured Label', 'openness' ),
		'description' => esc_html__( 'This lets you show the post summary featured label.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );

	// Show full post featured image
	$wp_customize->add_setting( 'openness_show_post_featured_image',	array(
		'default' => true,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_show_post_featured_image', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show Full Post Featured Image', 'openness' ),
		'description' => esc_html__( 'This lets you show the featured image in your full post.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );

	// show hide archive heading labels
	$wp_customize->add_setting( 'openness_show_archive_labels',	array(
		'default' => true,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_show_archive_labels', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show or hide the archive heading labels like Category:  or Tags: that show just before the names. Default is enabled to hide the label.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );	
	
	// Show dropcaps
	$wp_customize->add_setting( 'openness_show_dropcap',	array(
		'default' => true,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_show_dropcap', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show Full Post Dropcap', 'openness' ),
		'description' => esc_html__( 'This lets you show the drop cap style on the first letter of the first paragraph.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );	

	// Show summary meta info
	$wp_customize->add_setting( 'openness_summary_meta',	array(
		'default' => true,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_summary_meta', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show Post Summary Meta Info', 'openness' ),
		'description' => esc_html__( 'This lets you show the post summary meta information like date, author, categories, and more.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );
	
	// Show full post meta info
	$wp_customize->add_setting( 'openness_full_post_meta',	array(
		'default' => true,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_full_post_meta', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show Full Post Meta Info', 'openness' ),
		'description' => esc_html__( 'This lets you show the full post meta information like date, author, categories, and more.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );
	
	// Show author bio
	$wp_customize->add_setting( 'openness_authorbio',	array(
		'default' => true,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_authorbio', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Author Bio', 'openness' ),
		'description' => esc_html__( 'This lets you show the author bio information at the bottom of any post whenever you have more than one author.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );	
	
	// Show edit links
	$wp_customize->add_setting( 'openness_show_edit',	array(
		'default' => false,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_show_edit', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Edit Link', 'openness' ),
		'description' => esc_html__( 'This lets you show or hide the post edit link from the front-end of the site.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );	

	// Enable attachment comments
	$wp_customize->add_setting( 'openness_show_attachment_comments',	array(
		'default' => false,
		'sanitize_callback' => 'openness_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'openness_show_attachment_comments', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show Image Attachment Page Comments', 'openness' ),
		'description' => esc_html__( 'If you are using a WP gallery shortcode and want to showcase your images on the custom attachment page, you can enable or disable comments for images.', 'openness' ),
		'section'  => 'openness_theme_options',
	) );	
	
	// Copyright
	$wp_customize->add_setting( 'openness_copyright', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'openness_copyright', array(
		'settings' => 'openness_copyright',
		'label'    => esc_html__( 'Your Copyright Name', 'openness' ),
		'section'  => 'openness_theme_options',		
		'type'     => 'text',
	) ); 	
	





/*
 * Add to the Colours tab
 */
 
// sidebar column background
 	$wp_customize->add_setting( 'openness_sidebar_bg', array(
		'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_sidebar_bg', array(
		'label'   => esc_html__( 'Sidebar Column Background', 'openness' ),
		'description' => esc_html__( 'When no header image is used, this lets you set a colour for your sidebar column background.','openness'), 
		'section' => 'colors',
		'settings'   => 'openness_sidebar_bg',
	) ) );

// site title
 	$wp_customize->add_setting( 'openness_site_title', array(
		'default'        => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_site_title', array(
		'label'   => esc_html__( 'Site Title Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_site_title',
	) ) );

// site description
 	$wp_customize->add_setting( 'openness_site_description', array(
		'default'        => '#9d9d9d',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_site_description', array(
		'label'   => esc_html__( 'Site Description Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_site_description',
	) ) );

// menu colour
 	$wp_customize->add_setting( 'openness_menu_colour', array(
		'default'        => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_menu_colour', array(
		'label'   => esc_html__( 'Menu Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_menu_colour',
	) ) );

// menu description colour
 	$wp_customize->add_setting( 'openness_menu_description_colour', array(
		'default'        => '#9d9d9d',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_menu_description_colour', array(
		'label'   => esc_html__( 'Menu Description Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_menu_description_colour',
	) ) );

// menu border colour
 	$wp_customize->add_setting( 'openness_menu_border_colour', array(
		'default'        => '#eaeaea',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_menu_border_colour', array(
		'label'   => esc_html__( 'Menu Border Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_menu_border_colour',
	) ) );

// social icons
 	$wp_customize->add_setting( 'openness_social_icons', array(
		'default'        => '#b1ae29',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_social_icons', array(
		'label'   => esc_html__( 'Social Icons', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_social_icons',
	) ) );

// sidebar column widget titles
 	$wp_customize->add_setting( 'openness_sidebar_widget_titles', array(
		'default'        => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_sidebar_widget_titles', array(
		'label'   => esc_html__( 'Sidebar Column Widget Titles', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_sidebar_widget_titles',
	) ) );
	
// recent posts link
 	$wp_customize->add_setting( 'openness_recent_posts_link', array(
		'default'        => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_recent_posts_link', array(
		'label'   => esc_html__( 'Recent Posts Widget Link', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_recent_posts_link',
	) ) );	

// sidebar column text and link colour
 	$wp_customize->add_setting( 'openness_sidebar_column_text', array(
		'default'        => '#9d9d9d',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_sidebar_column_text', array(
		'label'   => esc_html__( 'Sidebar Column Text', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_sidebar_column_text',
	) ) );

// body text
 	$wp_customize->add_setting( 'openness_body_text', array(
		'default'        => '#737373',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_body_text', array(
		'label'   => esc_html__( 'Body Text Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_body_text',
	) ) );	
	
// headings and title colour
 	$wp_customize->add_setting( 'openness_heading_titles', array(
		'default'        => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_heading_titles', array(
		'label'   => esc_html__( 'Headings and Titles', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_heading_titles',
	) ) );

// post title hover colour
 	$wp_customize->add_setting( 'openness_entry_title_hover', array(
		'default'        => '#b1ae29',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_entry_title_hover', array(
		'label'   => esc_html__( 'Blog Post Title Hover Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_entry_title_hover',
	) ) );

// meta info colour
 	$wp_customize->add_setting( 'openness_meta_info', array(
		'default'        => '#9d9d9d',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_meta_info', array(
		'label'   => esc_html__( 'Meta Info Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_meta_info',
	) ) );

// footer top border
 	$wp_customize->add_setting( 'openness_footer_line', array(
		'default'        => '#eaeaea',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_footer_line', array(
		'label'   => esc_html__( 'Footer Line Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_footer_line',
	) ) );	
	
// footer text
 	$wp_customize->add_setting( 'openness_footer_text', array(
		'default'        => '#9d9d9d',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_footer_text', array(
		'label'   => esc_html__( 'Footer Text Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_footer_text',
	) ) );		
		
// caption text
 	$wp_customize->add_setting( 'openness_caption_text', array(
		'default'        => '#a5a21d',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_caption_text', array(
		'label'   => esc_html__( 'Caption Text', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_caption_text',
	) ) );	
	
// dropcap colour
 	$wp_customize->add_setting( 'openness_dropcap_colour', array(
		'default'        => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_dropcap_colour', array(
		'label'   => esc_html__( 'Dropcap Letter Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_dropcap_colour',
	) ) );		
	
// post tag background
 	$wp_customize->add_setting( 'openness_post_tag_bg', array(
		'default'        => '#b1ae29',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_post_tag_bg', array(
		'label'   => esc_html__( 'Post Tag Background', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_post_tag_bg',
	) ) );	
	
// post tag text
 	$wp_customize->add_setting( 'openness_post_tag_text', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_post_tag_text', array(
		'label'   => esc_html__( 'Post Tag Text', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_post_tag_text',
	) ) );		
	
// link colour
 	$wp_customize->add_setting( 'openness_link_colour', array(
		'default'        => '#b1ae29',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_link_colour', array(
		'label'   => esc_html__( 'Link Colour', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_link_colour',
	) ) );	


// more link background
 	$wp_customize->add_setting( 'openness_more_link_bg', array(
		'default'        => '#b1ae29',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_more_link_bg', array(
		'label'   => esc_html__( 'Read More Background', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_more_link_bg',
	) ) );	
	
// more link
 	$wp_customize->add_setting( 'openness_more_link', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_more_link', array(
		'label'   => esc_html__( 'Read More Text', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_more_link',
	) ) );	
	
// button background
 	$wp_customize->add_setting( 'openness_button_bg', array(
		'default'        => '#b1ae29',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_button_bg', array(
		'label'   => esc_html__( 'Button Background', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_button_bg',
	) ) );		
	
// button label
 	$wp_customize->add_setting( 'openness_button_label', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'openness_button_label', array(
		'label'   => esc_html__( 'Button Label', 'openness' ),
		'section' => 'colors',
		'settings'   => 'openness_button_label',
	) ) );		
	
}
add_action( 'customize_register', 'openness_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Openness 1.5
 * @see openness_customize_register()
 *
 * @return void
 */
function openness_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Openness 1.5
 * @see openness_customize_register()
 *
 * @return void
 */
function openness_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 * @since Openness 1.0
 */
function openness_customize_preview_js() {
	wp_enqueue_script( 'openness-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'openness_customize_preview_js' );



/**
 * SANITIZATION
 * Required for cleaning up bad inputs
 */

// Strip Slashes
	function openness_sanitize_strip_slashes($input) {
		return wp_kses_stripslashes($input);
	}	
	
// Radio and Select	
	function openness_sanitize_select( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;
		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
	 	
// Checkbox
	function openness_sanitize_checkbox( $input ) {
		// Boolean check 
		return ( ( isset( $input ) && true == $input ) ? true : false );
	}