<?php
/**
 * The template for displaying all single posts and attachments
 * @package Openness
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		
		<?php get_template_part( 'template-parts/sidebars/sidebar', 'banner' ); ?>
		<?php get_template_part( 'template-parts/sidebars/sidebar', 'breadcrumbs' ); ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/post/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			 	// single post navigation
				if ( esc_attr(get_theme_mod( 'openness_post_nav', 1 )) ) :
					get_template_part( 'template-parts/navigation/navigation', 'post' );
				endif;
			
		// End the loop.
		endwhile;
		?>
		
		<?php get_template_part( 'template-parts/sidebars/sidebar', 'bottom' ); ?>
		
		</main>
	</div>

<?php get_footer(); ?>
