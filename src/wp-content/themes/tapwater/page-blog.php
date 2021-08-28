<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://developer.wordpress.org/themes/basics/template-hierarchy/}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div class="container">
	
					<h1 class="section-title section-title--bright">Tap Water Blog</h1>

					<hr>
				
		<?php 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$query = new WP_Query([
			'post_type' => 'blog-post',
			'posts_per_page' => 10,
        	'paged' => $paged
		]);
		
		if ( $query->have_posts() ) : 
		
		?>

			
				
			

			<?php
			// Start the loop.
			while ( $query->have_posts() ) :
			    $query->the_post();
            ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="entry-header">
                    <a href="<?php the_permalink(); ?>"><h2 class="section-title section-title--bright-left blog-title"><?php the_title(); ?></h2></a>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
					<?php 
					
					if(get_the_excerpt()){
						the_excerpt();
					}else{
						wp_trim_words(get_the_content(), 60, '...');
					}
					
					?>

                    </div>

                </article>

            <?php

			
				
			endwhile;
			?>
			<div class="paginate">
				<?php 
					echo paginate_links( array(
						'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
						'total'        => $query->max_num_pages,
						'current'      => max( 1, get_query_var( 'paged' ) ),
						'format'       => '?paged=%#%',
						'show_all'     => false,
						'type'         => 'plain',
						'end_size'     => 2,
						'mid_size'     => 1,
						'prev_next'    => true,
						'prev_text'    => __( '&laquo; Previous' ),
        				'next_text'    => __( 'Next &raquo;' ),
						'add_args'     => false,
						'add_fragment' => '',
					) );
				?>
			</div>
			<?php
			

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
		<?php wp_reset_postdata(); ?>
	</div>		

<?php 
get_footer(); 


?>
