<?php
/**
 * The default template for displaying the full post
 * @package Openness
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		if( esc_attr(get_theme_mod( 'openness_show_post_featured_image', 1 ) ) ) :  
			openness_post_thumbnail();		
		endif; 
	?>
	
	<header class="entry-header">
								
		<?php	the_title( '<h1 class="entry-title">', '</h1>' );									
			if ( 'post' === get_post_type() && esc_attr(get_theme_mod( 'openness_full_post_meta', true )) ) {
			echo '<ul class="entry-meta">';			
				openness_posted_on();
				openness_categories();
				openness_posted_by();				
				openness_comments_count();	
				if( esc_attr(get_theme_mod( 'openness_show_edit', false ) ) ) {						
					openness_edit_link();
				}				
			echo '</ul>';
			
		};
		?>				
		</header>
		
	<div class="entry-content">
		<?php	the_content();?>	
	</div>
	
	<div id="entry-footer">
	<?php	openness_entry_footer(); ?>
	</div>
	
		<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) && esc_attr(get_theme_mod( 'openness_authorbio', 1 )) ) :
			get_template_part( 'author-bio' );
		endif;
		?>
	


</article>