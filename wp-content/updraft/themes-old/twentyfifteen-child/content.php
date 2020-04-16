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

           // More cities from same country
           if(is_single() && get_the_category()[0]->slug != 'home'):
           
           $category = get_the_category();
           $country = $category[1]->name;
           $country_slug = $category[1]->slug;
           $postid = get_the_ID();
           ?>
           
           <?php
           $query = new WP_Query(array(
           	'category_name' => $country_slug,
            'post_type' => 'post',
            'post__not_in' => array($postid) //do not display current post
            
           )); 
           ?>
           	<ul class="country-list">
           <?php
           if($query->have_posts()){ //display only if query has other cities
           ?>
           <h3>Check tap water safety for other cities in <a href="<?php echo site_url("/$country_slug"); ?>"><?php echo $country; ?></a></h3>
           <?php
               while($query->have_posts()){
                $query->the_post();
                if(get_post_type() != 'page'):
                ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_field('city_name'); ?></li>
                <?php
                endif;
               }
           }
           ?>
           </ul>
           <?php
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