<?php
/**
 * The default template for displaying content
 * Used for both single and index/archive/search.
 * @package Openness
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php 
		if ( esc_attr(get_theme_mod( 'openness_centered_thumbnails', false )) ) :
			the_post_thumbnail( 'openness-centered' );  
		else :
			the_post_thumbnail( 'post-thumbnails' ); 
		endif;				
		?>
</a>
	<header class="entry-header">

	<?php 	if ( is_sticky() && is_home() && ! is_paged() && esc_attr(get_theme_mod( 'openness_show_featured_label', 1 )) ) :
		printf( '<span class="featured-post">%s</span>', esc_html__( 'Featured', 'openness' ) );
	endif; ?>
	
	<?php	the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<?php // get the post meta information - each one can be disabled.
					if ( 'post' === get_post_type() && esc_attr(get_theme_mod( 'openness_summary_meta', true )) ) {
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
	

	<div class="entry-content">
	
				<?php
				if ( esc_attr(get_theme_mod( 'openness_use_excerpt', false )) ) :
					the_excerpt();
				else :
				
					the_content( sprintf(
					/* translators: %s: Name of current post */
						__( 'Continue Reading<span class="screen-reader-text"> "%s"</span>', 'openness' ),
						get_the_title()
					) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'openness' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'openness' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			
		endif;
	?>	

	</div>

	<footer class="entry-footer"></footer>

</article>