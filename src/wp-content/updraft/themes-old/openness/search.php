<?php
/**
 * The template for displaying search results pages.
 * @package Openness
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php 
				/* translators: %s: keywords */
				printf( esc_html__( 'Search Results for: %s', 'openness' ), get_search_query() ); ?></h1>
			</header>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); 

			get_template_part( 'template-parts/post/content', 'excerpt' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			get_template_part( 'template-parts/navigation/navigation', 'blog' );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main>
	</section>

<?php get_footer(); ?>
