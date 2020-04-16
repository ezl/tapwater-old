<?php
/**
 * The template used for displaying page content
 * @package Openness
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		openness_post_thumbnail();
	?>

	<header class="entry-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'openness' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'openness' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div>

	<?php if ( esc_attr(get_theme_mod( 'openness_show_edit', 1 )) ) :
	edit_post_link( esc_html__( 'Edit', 'openness' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); 
	endif; ?>

</article>