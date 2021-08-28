<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://developer.wordpress.org/themes/basics/template-hierarchy/}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	<header class="entry-header">
	
		<?php breadcrumbs(); ?>
	
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<span class="modified">last modified: <?php echo get_the_modified_date();  ?></span>
		<p>
			<?php 
				if(get_the_content()):
					echo wp_trim_words( get_the_content(), 35, '... ' ); 
					echo '<a href="'.get_the_permalink().'">read more';
				endif;
			?>
		</p>
	</div>
	
	

	<?php if ( 'post' == get_post_type() ) : ?>

		<!--<footer class="entry-footer">
			
			<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>--><!-- .entry-footer -->

	<?php else : ?>

		<?php //edit_post_link( __( 'Edit', 'twentyfifteen' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
