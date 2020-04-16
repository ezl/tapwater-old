<?php 
add_action( 'wp_enqueue_scripts', 'education_online_theme_css',20);
function education_online_theme_css() {
	wp_enqueue_style( 'education-online-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'education-online-style',get_stylesheet_directory_uri() . '/css/education-online.css');
}