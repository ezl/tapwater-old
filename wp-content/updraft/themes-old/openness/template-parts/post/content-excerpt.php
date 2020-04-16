<?php
/**
 * Template part for displaying posts with excerpts
 * @package Openness
*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( is_front_page() && ! is_home() ) {

			// The excerpt is being displayed within a front page section, so it's a lower hierarchy than h2.
			the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		} else {
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		} ?>		
		
					<?php // get the post meta information - each one can be disabled.
					if ( 'post' === get_post_type() ) {
						echo '<ul class="entry-meta">';								
						if( is_multi_author() && esc_attr(get_theme_mod( 'openness_show_post_author', true ) ) ) :	
							openness_posted_by();
						endif;	
						if( esc_attr(get_theme_mod( 'openness_show_post_date', true ) ) ) :
							openness_posted_on();
						endif;	

						if( esc_attr(get_theme_mod( 'openness_show_post_comments', true ) ) ) :	
							openness_comments_count();
						endif;	
							echo '</ul>';
					} 									
				?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

</article>
