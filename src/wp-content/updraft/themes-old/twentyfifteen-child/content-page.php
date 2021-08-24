<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

global $post;
$curID = $post->ID;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php


    breadcrumbs();


    
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
	?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content();
    $categories = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'names', 'orderby' => 'term_id')); 
if($categories[1])://only show if is country page
	  
    
    $country_name = $categories[1];
   echo '<h3>View our tap water report on all cities in '.$country_name.'</h3>';
   echo '<ul class="country-list">';
    $query = new WP_Query(array(
    	'post_type' => 'post',
        'category_name' => $country_name
    ));
    
    while($query->have_posts()):
    $currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'names', 'orderby' => 'term_id')); 
    	$query->the_post();
    if(get_post_type() == 'post' && $currentcat[1]):
        echo '<li><a href="'.get_permalink().'">'.get_field('city_name').'</a></li>';
        endif;
    endwhile;
    
    echo '</ul>';
    
    wp_reset_postdata();
    
    //show more countries in same continent
    
    $continent_name = $categories[0];
    
    $query = new WP_Query(array(
    	'post_type' => 'page',
    	'category_name' => $continent_name,
        'post_status' => 'any'
    ));
    if($query->have_posts()):
    echo '<h3>View other countries in '.$continent_name.'</h3>';
    echo '<ul class="country-list">';
    while($query->have_posts()):
    	$query->the_post();
        $currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'names', 'orderby' => 'term_id'));
        
        if(get_post_type() == 'page' && $currentcat[1] && $curID != get_the_ID()){
       echo '<li><a href="'.get_the_permalink().'">'.$currentcat[1].'</a></li>';
       
        
        }
    endwhile;
    echo '</ul>';
    endif;
    
    wp_reset_postdata();
    
    
endif;

// if continent page show list of countries in continent and cities list
 $categories = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id')); 

if($categories[0] && !$categories[1]):
?><div class="continent-page-list"><?php	
   
	$countries = get_categories(array(
    'parent'  => $categories[0]->term_id
    ));
    if($countries):
    ?><h2><strong>Select country</strong></h2><div class="mainpage-category-subnav"><?php
    $n = 0;
    foreach($countries as $country):
    $n++;?>
  <div class="subcategory-nav-item<?php if($n == 1){echo ' active';} ?>" data-region="<?php echo $country->slug; ?>"><?php echo $country->name; ?></div>
        <?php
    endforeach;
    ?></div><?php
    endif;
    $n = 0;
    foreach($countries as $country):
    $n++;
    	 $query = new WP_Query(array(
        	'post_type' => 'post',
        	'category_name' => $country->slug,
            'post_status' => 'all'
        ));
        ?>
        <div class="region<?php if($n == 1){echo ' active';} ?>" data-region="<?php echo $country->slug; ?>">
        <?php
        if($query->have_posts()):
        	while($query->have_posts()):
            $countrycat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id')); 
            
            	$query->the_post();
                if(get_post_type() == 'post'):
                ?>
                
            	<div class="country"><h2><a href="<?php the_permalink(); ?>"><?php the_field('city_name'); ?></a></h2></div>
                <?php
                endif;
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
        </div>
        <?php
    endforeach;
    
?></div><?php    
    
endif;
        


		
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

	

</article><!-- #post-<?php the_ID(); ?> -->