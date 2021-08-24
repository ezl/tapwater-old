<?php
/**
 * Custom template tags for Openness
 * Eventually, some of the functionality here could be replaced by core features.
 * @package Openness
 */

 
// Prints HTML with meta information for the current post-date/time.
if ( ! function_exists( 'openness_posted_on' ) ) :
	function openness_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on = sprintf(
			/* translators: %s: post date. */
			//esc_html_x( 'Posted %s', 'post date', 'openness' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo '<li class="posted-on">' . $posted_on . '</li>'; // WPCS: XSS OK.
	}
endif; 


// Prints HTML with meta information for the current author.
if ( ! function_exists( 'openness_posted_by' ) ) :
	function openness_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			//esc_html_x( 'by %s', 'post author', 'openness' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<li class="byline"> ' . $byline . '</li>'; // WPCS: XSS OK.
	}
endif;

 
if ( ! function_exists( 'openness_comments_count' ) ) :
	function openness_comments_count() {
		// Add the comments link to the post meta info
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'openness' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</li>';
		}
}

endif; 
 
 
// Edit link function
if ( ! function_exists( 'openness_edit_link' ) ) :
	function openness_edit_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'openness' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<li class="edit-link">',
			'</li>'
		);
	}
endif; 
 
 
// Add categories to the post meta info
if ( ! function_exists( 'openness_categories' ) ) :
function openness_categories() {
		
		// Add categories to the post meta info
		$categories_list = get_the_category_list( esc_html__( ', ', 'openness' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<li class="cat-links">' . esc_html__( 'In %1$s', 'openness' ) . '</li>', $categories_list ); // WPCS: XSS OK.
		}
	}
endif;

/**
 * Prints HTML with meta information for the categories, tags.
 * @since Openness 1.0
 */
if ( ! function_exists( 'openness_entry_footer' ) ) :

	//Prints HTML with meta information for the tags
	function openness_entry_footer() {
		
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {			
			// Get tag list
			if(get_the_tag_list()) {
				echo wp_kses_post(get_the_tag_list('<ul class="tag-list"><li>','</li><li>','</li></ul>'));
			}
		}	
	}
endif; 
 
 

if ( ! function_exists( 'openness_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Openness 1.0
 */
function openness_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'openness' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'openness' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', esc_attr($prev_link) );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'openness' ) ) ) :
					printf( '<div class="nav-next">%s</div>', esc_attr($next_link) );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;


/**
 * Determine whether blog/site has more than one category.
 * @return bool True of there is more than one category, false otherwise.
 */
function openness_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'openness_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'openness_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 || is_preview() ) {
		// This blog has more than 1 category so openness_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so openness_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see openness_categorized_blog()}.
 *
 * @since Openness 1.0
 */
function openness_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'openness_categories' );
}
add_action( 'edit_category', 'openness_category_transient_flusher' );
add_action( 'save_post',     'openness_category_transient_flusher' );

if ( ! function_exists( 'openness_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Openness 1.0
 */
function openness_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'openness_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Openness 1.0
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function openness_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;


if ( ! function_exists( 'openness_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Openness 1.5
 */
function openness_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


/**
 * Lets create a custom archive title set.
 * This will remove the labels from archive titles if the theme option is enabled from the customizer.
 * To show the labels like Category: or Tags: etc....uncheck the theme option.
 */
 if ( esc_attr(get_theme_mod( 'openness_show_archive_labels', true ) ) ) :
 
if ( ! function_exists( 'openness_archive_title' ) ) :

function openness_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = sprintf( 
		/* translators: %s: Name of tag */
		esc_html__( 'Articles with %s', 'openness' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( 
		/* translators: %s: Name of author */
		esc_html__( 'Articles by %s', 'openness' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( 
		/* translators: %s: Name of year */
		esc_html__( 'Articles from: %s', 'openness' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'openness' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( 
		/* translators: %s: Name of month  */
		esc_html__( 'Articles from %s', 'openness' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'openness' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( 
		/* translators: %s: Name of day */
		esc_html__( 'Articles from %s', 'openness' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'openness' ) ) );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( 
		/* translators: %s: Name of archive title */
		esc_html__( 'Archives: %s', 'openness' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( 
		/* translators: %s: Name of title  */
		esc_html__( '%1$s: %2$s', 'openness' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'openness' );
	}

	/**
	 * Filter the archive title.
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;
endif;
