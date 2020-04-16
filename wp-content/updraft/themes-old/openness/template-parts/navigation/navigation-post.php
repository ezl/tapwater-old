<?php
/**
 * Template part for displaying post navigation - next and previous posts
 * @package Openness
*/

the_post_navigation( array(
	'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Post', 'openness' ) . '</span> ' .
		'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'openness' ) . '</span> ' .
		'<span class="post-title">%title</span>',
	'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Post', 'openness' ) . '</span> ' .
		'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'openness' ) . '</span> ' .
		'<span class="post-title">%title</span>',
) );			
				
?>