<?php


get_header(); 

global $wp_query;

?>
	<section class="container">
		

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="section-title section-title--bright"><?php printf( __( 'SEARCH', 'twentyfifteen' ) ); ?></h1>
				
				<p class="search-subtitle"><?php echo $wp_query->found_posts; ?> search results for: <span class="search-term"><?php echo get_search_query(); ?></span></p>

			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();
				?>

				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
					'next_text'          => __( 'Next page', 'twentyfifteen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'twentyfifteen' ) . ' </span>',
				)
			);

			// If no content, include the "No posts found" template.
		else :
			?>

			<h2>No results for: <?php echo get_search_query(); ?></h2>
			<?php get_search_form(); ?>

			<?php

		endif;
		?>

		
	</section><!-- .content-area -->

<?php get_footer(); ?>
