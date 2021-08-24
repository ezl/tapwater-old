<?php
/**
 * The template for displaying Author bios
 * @package Openness
 */
?>

<div class="author-info">
	<h2 class="author-heading"><?php esc_html_e( 'Article Writter By', 'openness' ); ?></h2>
	<div class="author-avatar">
		<?php
		$author_bio_avatar_size = apply_filters( 'openness_author_bio_avatar_size', 56 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div>

	<div class="author-description">
		<h3 class="author-title"><?php echo get_the_author(); ?></h3>

		<div class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php 
				/* translators: %s: Author name */
				printf( esc_html__( 'View all posts by %s', 'openness' ), get_the_author() ); ?>
			</a>
		</div>

	</div>
</div>
