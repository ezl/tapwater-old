<?php
/**
 * Customized comment style 
 * @package Openness
 */

function comment_style( $comment, $args, $depth ) {
	global $post;
	$author_id = $post->post_author;
?>

	<li id="li-comment-<?php comment_ID(); ?>" class="media">
	
		<article id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
			<div class="comment-author vcard commenter">
				<?php echo get_avatar( $comment, 60 ); ?>
			</div><!-- .comment-author -->
			<div class="comment-details clr media-body comment_body">
				<header class="comment-meta">
					<cite class="fn commenter_name title bypostauthor"><?php comment_author_link(); ?></cite>
					<div class="comment-date comment_info">
					<?php printf(
					/* translators: %1$s: linked date. %2$s: date time. %3$s: date time */
					'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( 
						/* translators: %1$s: comment date time */
						esc_attr_x( 'Commented on %1$s', 'The date', 'openness' ), get_comment_date() )); ?> 
					
				<span class="reply comment-reply-link">
					<?php comment_reply_link( array_merge( $args, array(
						'reply_text' => esc_html__( '&ndash; Reply', 'openness' ),
						'depth'      => $depth,
						'max_depth'	 => $args['max_depth'] )
					) ); ?>
				</span><!-- .reply -->
									
					</div><!-- .comment-date -->
				</header><!-- .comment-meta -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'openness' ); ?></p>
				<?php endif; ?>
				<div class="comment-content entry clr">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

			</div><!-- .comment-details -->
		</article><!-- #comment-## -->
	<?php
		 // End comment_type check.
}