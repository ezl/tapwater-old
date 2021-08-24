<?php
/**
 * The template part for displaying results in search pages
 * @package Openness
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php openness_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<?php if ( 'post' == get_post_type() ) : ?>

		<footer class="entry-footer">
			<?php openness_entry_meta(); ?>
			<?php if ( esc_attr(get_theme_mod( 'openness_show_edit', 1 )) ) :
			edit_post_link( esc_html__( 'Edit', 'openness' ), '<span class="edit-link">', '</span>' ); 
			endif; ?>
		</footer>

	<?php else : ?>

		<?php edit_post_link( esc_html__( 'Edit', 'openness' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>

	<?php endif; ?>

</article>
