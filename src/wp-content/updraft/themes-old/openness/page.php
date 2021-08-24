<?php
/**
 * The template for displaying pages
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

			// Include the page content template.
			get_template_part( 'template-parts/page/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

		<?php get_template_part( 'template-parts/sidebars/sidebar', 'bottom' ); ?>
		
		</main>
	</div>

<?php get_footer(); ?>
