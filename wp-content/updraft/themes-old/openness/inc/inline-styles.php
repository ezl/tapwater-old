<?php
/**
 * Add inline styles to the head area
 * @package Openness
*/
 
 // Dynamic styles
function openness_inline_styles($openness_custom) {
	
// BEGIN CUSTOM CSS	

// sidebar colours
	$openness_sidebar_bg = get_theme_mod( 'openness_sidebar_bg', '#ffffff' );
	$openness_site_title = get_theme_mod( 'openness_site_title', '#000' );
	$openness_site_description = get_theme_mod( 'openness_site_description', '#9d9d9d' );
	$openness_menu_colour = get_theme_mod( 'openness_menu_colour', '#333' );
	$openness_menu_description_colour = get_theme_mod( 'openness_menu_description_colour', '#9d9d9d' );
	$openness_menu_border_colour = get_theme_mod( 'openness_menu_border_colour', '#eaeaea' );
	$openness_social_icons = get_theme_mod( 'openness_social_icons', '#b1ae29' );
	$openness_sidebar_widget_titles = get_theme_mod( 'openness_sidebar_widget_titles', '#333' );
	$openness_sidebar_column_text = get_theme_mod( 'openness_sidebar_column_text', '#9d9d9d' );
	$openness_recent_posts_link = get_theme_mod( 'openness_recent_posts_link', '#333' );
	$openness_custom .= "body:before {background-color:" . esc_attr($openness_sidebar_bg) . "}
	.site-title a, .site-title a:visited { color: " . esc_attr($openness_site_title) . ";}
	.site-description { color: " . esc_attr($openness_site_description) . ";}
	.main-navigation a, .main-navigation a:visited { color: " . esc_attr($openness_menu_colour) . ";}
	.main-navigation .menu-item-description { color: " . esc_attr($openness_menu_description_colour) . ";}
	.main-navigation li  { border-color: " . esc_attr($openness_menu_border_colour) . ";} 	
	.social-navigation a:before { color: " . esc_attr($openness_social_icons) . ";}	
	.secondary .widget-title { color: " . esc_attr($openness_sidebar_widget_titles) . ";}
	.secondary .widget, .secondary .widget li a, .secondary .widget li a:visited { color: " . esc_attr($openness_sidebar_column_text) . ";}
	.secondary .widget.widget_openness-recent-posts h4 a	{ color: " . esc_attr($openness_recent_posts_link) . ";}
	@media screen and (min-width: 38.75em) {
	.main-navigation ul { border-color: " . esc_attr($openness_menu_border_colour) . ";}
	} "."\n";

// main content colours
	$openness_body_text = get_theme_mod( 'openness_body_text', '#737373' );
	$openness_link_colour = get_theme_mod( 'openness_link_colour', '#b1ae29' );
	$openness_heading_titles = get_theme_mod( 'openness_heading_titles', '#333' );
	$openness_entry_title_hover = get_theme_mod( 'openness_entry_title_hover', '#b1ae29' );	
	$openness_meta_info = get_theme_mod( 'openness_meta_info', '#9d9d9d' );
	$openness_footer_line = get_theme_mod( 'openness_footer_line', '#eaeaea' );
	$openness_footer_text = get_theme_mod( 'openness_footer_text', '#9d9d9d' );
	$openness_caption_text = get_theme_mod( 'openness_caption_text', '#a5a21d' );
	$openness_more_link_bg = get_theme_mod( 'openness_more_link_bg', '#b1ae29' );
	$openness_more_link = get_theme_mod( 'openness_more_link', '#fff' );
	$openness_post_tag_bg = get_theme_mod( 'openness_post_tag_bg', '#b1ae29' );
	$openness_post_tag_text = get_theme_mod( 'openness_post_tag_text', '#fff' );	
	$openness_custom .= "body {color:" . esc_attr($openness_body_text) . "}
	a, a:visited, .entry-content p a:visited, .entry-footer a, .entry-content p a, .site-info a {color:" . esc_attr($openness_link_colour) . "}
	p a.more-link, p a.more-link:visited {background-color:" . esc_attr($openness_more_link_bg) . "; color:" . esc_attr($openness_more_link) . "}
	h1, h2, h3, h4, h5, h6, .entry-title a, .entry-title a:visited, .comment-author {color:" . esc_attr($openness_heading_titles) . "}
	.entry-title a:hover {color:" . esc_attr($openness_entry_title_hover) . "}
	.entry-meta, .entry-meta a, .entry-meta a:visited, .comment-metadata a, .pingback .edit-link a {color:" . esc_attr($openness_meta_info) . "}	
	.site-footer, .single .hentry, .comments-list li:last-child {border-color:" . esc_attr($openness_footer_line) . "}	
	.site-info, .site-info a, .site-info a:visited {color:" . esc_attr($openness_footer_text) . "}
	.gallery-caption, .wp-caption-text {color:" . esc_attr($openness_caption_text) . "}
	.tag-list a, .tag-list a:visited {background-color:" . esc_attr($openness_post_tag_bg) . "; color:" . esc_attr($openness_post_tag_text) . "}	"."\n";	
	
// form elements
	$openness_button_bg = get_theme_mod( 'openness_button_bg', '#b1ae29' );
	$openness_button_label = get_theme_mod( 'openness_button_label', '#fff' );
	$openness_custom .= "button, input[type=button], input[type=reset], input[type=submit], .prev-image a,.next-image a, .prev-image a:focus,.prev-image a:hover,.next-image a:focus, .next-image a:hover {background-color:" . esc_attr($openness_post_tag_bg) . "; color:" . esc_attr($openness_post_tag_text) . "}
	"."\n";	
	
// center our post summary is using excerpts
	if( esc_attr(get_theme_mod( 'openness_use_excerpt', false ) ) ) :
	$openness_custom .= ".blog-standard .hentry {text-align:center;}"."\n";
	endif;
	
// Drop cap
	if( esc_attr(get_theme_mod( 'openness_show_dropcap', true ) ) ) :
		$openness_dropcap_colour = get_theme_mod( 'openness_dropcap_colour', '#333' );
		$openness_custom .= ".single-post .entry-content > p:first-of-type::first-letter {color:" . esc_attr($openness_dropcap_colour) . ";
		font-weight: 700;
		font-style: normal;
		font-family: \"Times New Roman\", Times, serif;
		font-size: 6rem;
		font-weight: normal;
		line-height: 0.8;
		float: left;
		margin: 6px 0 0;
		padding-right: 8px;
		text-transform: uppercase;
	}
	.single-post .entry-content h2 ~ p:first-of-type::first-letter {
		font-size: initial;	
		font-weight: initial;	
		line-height: initial; 
		float: initial;	
		margin-bottom: initial;	
		padding-right: initial;	
		text-transform: initial;
	}	"."\n";
	endif;


	
// END CUSTOM CSS

//Output all the styles
	wp_add_inline_style( 'openness-style', $openness_custom );	
}
add_action( 'wp_enqueue_scripts', 'openness_inline_styles' );	