<?php
/**
 * Template part for displaying the boxes blog style posts
 * @package Openness
*/
?>


<div class="col-lg-6">

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<?php if ( '' !== get_the_post_thumbnail() ) : ?>	
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">		
				<?php the_post_thumbnail( 'openness-cards' ); ?>
				</a>
		<?php endif; ?>
    <div class="card-body">
     	<header class="card-title entry-header">
	
		<?php		
		if ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}		
		?>
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
		<?php	the_excerpt(); ?>
	</div>
    </div>
	</article>
  </div>