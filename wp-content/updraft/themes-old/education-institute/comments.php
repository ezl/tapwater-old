<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage education-institute
 * @since education-institute 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/

if ( post_password_required() ) {
    return;
}
?>
<div class="col-lg-12">
    <div class="user-comments">
        <div class="left-title-des">    
            <?php if ( have_comments() ) : ?>
                <h2 class="section-title ex p-b-0 text-left">
                    <?php
                            $comments_number = get_comments_number();
                            if ( 1 === $comments_number ) {
                                /* translators: %s: post title */
                                printf( esc_html__( 'One thought on &ldquo;%s&rdquo;','education-institute' ), get_the_title() );
                            } else {                    
                                printf(
                                    esc_html(
                                        /* translators: 1: number of comments, 2: post title */
                                        _nx( 
                                            '%1$s thought on &ldquo;%2$s&rdquo;',
                                            '%1$s thoughts on &ldquo;%2$s&rdquo;',
                                            $comments_number,
                                            'comments title',
                                            'education-institute'
                                        )
                                    ),
                                    esc_html (number_format_i18n( $comments_number ) ),
                                    get_the_title()
                                );
                            }
                        ?>
                    <span class="title-sep grey-sep"></span>
                </h2>
                <div class="comment-wapper">
                    <?php the_comments_navigation(); ?>
                    <ul>
                        <?php
                            wp_list_comments( array(
                                'style'       => 'ul',
                                'short_ping'  => true,
                                'avatar_size' => 42,
                            ) );
                        ?>
                    </ul>
                </div>
                <!-- .comment-list -->
                <?php the_comments_navigation(); ?>
              <?php
            endif; // Check for have_comments(). ?>
        </div>
    </div>
</div>
    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'education-institute' ) ) : ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'education-institute' ); ?></p> <?php
        endif; ?>

<div class="col-lg-12">
    <div class="comment-box">
        <div class="left-title-des">
            <h3 class="h3"><?php echo esc_html__('Leave','education-institute'); ?><span class="theme-text"><?php echo esc_html__('Comment','education-institute'); ?></span>
                <span class="title-sep"></span>
            </h3>
            <div class="comment-wapper">
                <?php comment_form(); ?>
            </div>
        </div>
    </div>
</div>