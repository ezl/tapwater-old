<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

    breadcrumbs();

   
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
	?>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
			?>
	</header><!-- .entry-header -->

	<div class="entry-content">
        
		<?php
		if(get_field('price')){
		?>
		<figure class="wp-block-table aligncenter is-style-stripes table-1">
    
    <table class="">
        
        <tbody>
            <tr>
                <td>Safe to drink?</td>
                <td class="has-text-align-right table-bool" data-align="right"><?php the_field('safe'); ?></td></tr>
            <tr>
                <td>Passed the WHO International Standard or the EPA Standard?</td>
                <td class="has-text-align-right table-bool" data-align="right"><?php the_field('passed_standard'); ?></td></tr>
            <tr>
                <td>The estimated price of bottled water in USD(1.5-liter)</td>
                <td class="has-text-align-right" data-align="right">$<?php the_field('price'); ?></td></tr>
        
        </tbody>
    
    </table>

</figure>
		<?php
		}
		
		
		
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

    <?php
        // Display more cities from same country - city page

        
            //only show if not home category post
            if(is_single() && get_the_category()[0]->slug != 'home'): 
                //get current categories for post 0-continent 1-xountry
                $currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id')); 
            
                $query = new WP_Query(array(
                    'category_name' => $currentcat[1]->slug,
                    'post__not_in' => array(get_the_ID())

                ));
                
                if($query->have_posts() && $query->found_posts > 1)://do not display if only one city in country, because that city  == current city
                    ?>
                    <h3>Check tap water safety for other cities in <a href="<?php echo site_url('/tap-water-safety-in-').$currentcat[1]->slug; ?>"><?php echo $currentcat[1]->name; ?></a></h3>
                    <ul class="country-list">
                    <?php
                    while($query->have_posts()):
                        $query->the_post();
                        if(get_post_type() == 'post')://only show posts - cities
                        ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_field('city_name'); ?></li>
                        <?php
                        endif;
                    endwhile;
                    ?>
                    </ul>
                    <?php
                endif;

                wp_reset_postdata();
            endif;
       
    ?>
            

           
	</div><!-- .entry-content -->

	<?php
		// Author bio.
	if ( is_single() && get_the_author_meta( 'description' ) ) :
		get_template_part( 'author-bio' );
		endif;
	?>

	

</article><!-- #post-<?php the_ID(); ?> -->