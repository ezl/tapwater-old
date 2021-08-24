<?php 
/**
 * Register theme sidebars
 * @package Openness
*/
 
function openness_widgets_init() {

	register_sidebar( array(
		'name' => esc_html__( 'Sidebar Column', 'openness' ),
		'id' => 'sidebar-column',
		'description'   => esc_html__( 'Add widgets your sidebar column area.', 'openness' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Banner', 'openness' ),
		'id' => 'banner',
		'description' => esc_html__( 'Use this sidebar position to publish images or your favorite slider.', 'openness' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );	
	
	register_sidebar( array(
		'name' => esc_html__( 'Breadcrumbs', 'openness' ),
		'id' => 'breadcrumbs',
		'description' => esc_html__( 'For adding breadcrumb navigation if using a plugin, or you can add content here.', 'openness' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Bottom', 'openness' ),
		'id' => 'bottom1',
		'description' => esc_html__( 'Bottom 1 position', 'openness' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Footer', 'openness' ),
		'id' => 'footer',
		'description' => esc_html__( 'This is a sidebar position that sits above the footer menu and copyright', 'openness' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );


	register_widget( 'Openness_Recent_Posts_Widget' );
	
}
add_action( 'widgets_init', 'openness_widgets_init' );




// Count the number of widgets to enable resizable widgets in the bottom group.
function openness_bottom() {
	$count = 0;
	if ( is_active_sidebar( 'bottom1' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-lg-12';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr($class) . '"';
}