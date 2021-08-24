<?php
/**
 * Template part for the blog navigation - previous and next
 * @package Openness
*/

	the_posts_pagination( array(
		'prev_text'  => false,
		'next_text'  => false,
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'openness' ) . ' </span>',
	) );

?>