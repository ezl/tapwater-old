<?php
/**
 * The template for displaying comments
 * This is the template that displays the area of the page that contains both the current comments and the comment form.
 * @package Openness

 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : 
		the_comments_navigation(); 
		endif; ?>
		
<ol class="media-list comments-list">
<?php
// Display comments
wp_list_comments( array(
	'callback' => 'comment_style'
) );
?>
</ol>


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : 
		the_comments_navigation(); 
		endif; ?>

	<?php endif; ?>

	<?php
		/* Message to display when comments are closed */
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			echo '<div id="nocomments" class="notification info"><div class="icon">' . esc_html_e( 'Comments are closed.', 'openness' ) . '</div></div>';
		endif; ?>

	<?php 
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		// For opt-in relating to GDPR
		$consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		
		$comments_args = array(
			'label_submit' => esc_html__( 'Submit Comment', 'openness' ),
			'title_reply'  => esc_html__( 'Write a Comment', 'openness'  ),
			'comment_notes_after' => '',
			'comment_field' =>  
				'<p class="comment-form-comment">' .
				'<textarea id="comment" name="comment" placeholder="' . esc_attr__( '* Message', 'openness' ) . '" rows="8" aria-required="true">' .
				'</textarea></p>',
			'fields' => apply_filters( 'comment_form_default_fields', array (
				'author' =>
					'<div class="comment-form-column-wrapper"><p class="comment-form-author comment-form-column">' .
					'<input id="author" name="author" placeholder="' . esc_attr__( '* Name', 'openness' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'"' . $aria_req . ' /></p>',
				'email' =>
					'<p class="comment-form-email comment-form-column">' .
					'<input id="email" name="email" placeholder="' . esc_attr__( '* Email', 'openness' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'"' . $aria_req . ' /></p>',
				'url' =>
					'<p class="comment-form-url comment-form-column">' .
					'<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'openness' ). '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" /></p></div>',
					'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
  '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.','openness' ) . '</label></p>',
			) ),
		);
		comment_form( $comments_args );
	?>

</div><!-- #comments -->
