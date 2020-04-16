<?php
/**
 * The template for displaying image attachments
 * @package Openness
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
				while ( have_posts() ) : the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header>

					<div class="entry-content">

						<div class="entry-attachment">
						<div id="attachment-wrapper">
							<?php
								$image_size = apply_filters( 'openness_attachment_size', 'large' );
								echo wp_get_attachment_image( get_the_ID(), $image_size );
							?>
						</div>
						
							<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
							<?php endif; ?>

						</div>

						<?php
							the_content();
						?>
					</div>

					<footer class="entry-footer">
					<nav id="image-navigation" class="navigation image-navigation">
						<div class="nav-links">
							<div class="prev-image"><?php previous_image_link( false, esc_html__( 'Previous Image', 'openness' ) ); ?></div>
							<div class="next-image"><?php next_image_link( false, esc_html__( 'Next Image', 'openness' ) ); ?></div>
						</div>
					</nav>
					</footer>

				</article>

			
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if (esc_attr(get_theme_mod( 'openness_show_attachment_comments', false ) ) &&  comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				// End the loop.
				endwhile;
			?>

		</main>
	</div>

<?php get_footer(); ?>
