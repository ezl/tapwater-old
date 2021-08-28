<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); 

if(has_post_thumbnail()){
    the_post_thumbnail('full', array('class' => 'page-hero-image'));
}

?>

	<div class="container">
		

		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the post format-specific template for the content. If you want
			 * to use this in a child theme, then include a file called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
            ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



<header class="entry-header" style="display:block;">
    <?php
    if ( is_single() ) :
        the_title( '<h1 class="section-title section-title--bright">', '</h1>' );
        else :
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        endif;
        ?>
        <hr>
</header><!-- .entry-header -->

<div class="entry-content">
    
    <?php    
    
        /* translators: %s: Name of current post */
        the_content(
            sprintf(
                __( 'Continue reading %s', 'twentyfifteen' ),
                the_title( '<span class="screen-reader-text">', '</span>', false )
            )
        );
        
        

        wp_link_pages(
            array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            )



        );
        
   
        
   
?>
        

       
</div><!-- .entry-content -->

<?php
    // Author bio.
if ( is_single() && get_the_author_meta( 'description' ) ) :
    get_template_part( 'author-bio' );
    endif;
?>



</article><!-- #post-<?php the_ID(); ?> -->

            <?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			

			// End the loop.
		endwhile;
		?>

		
	</div><!-- .content-area -->

<?php get_footer(); ?>
