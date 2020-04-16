<?php
get_header();
while(have_posts()){
	the_post();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
	?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
        the_content(); 
        
        
        ?>
		
	</div><!-- .entry-content -->

	

</article><!-- #post-<?php the_ID(); ?> -->
<?php
}


?>
<h2 class="region-select"><strong>Select a region</strong></h2>
	<div class="mainpage-category-subnav">
<?php
// Show categories subnav
                
                $regions = get_categories(array(
                	'orderby' => 'name',
                    'parent' => 0,
                    'exclude' => array(21, 1)         
                ));
                
                $n = 0;
                foreach($regions as $region){
                $n++;
               ?>
               	<div class="subcategory-nav-item <?php if($n == 1){echo ' active';}?>" data-region="<?php echo $region->slug; ?>">
               <?php
                echo $region->name;
               ?>
               	</div>
               <?php
                }
?>
	</div>
<?php
$n = 0;
foreach($regions as $region){
$n++;
?>

<div class="region <?php if($n == 1){echo 'active';} ?>" data-region="<?php echo $region->slug; ?>">
<?php
	$countries = get_categories(array(
    	'parent' => $region->cat_ID
    ));
    
    foreach($countries as $country){
    
    ?>
    <div class="country <?php echo $country->slug; ?>">	
    <?php
    
    	echo '<h2><a href="'.site_url('/tap-water-safety-in-').$country->slug.'">'.$country->name.'</a></h2><ul>';
    	
        
        
       	
        $query = new WP_Query(array(
        	'post_type' => 'post',
        	'category_name' => $country->name
        ));
        while($query->have_posts()){
        	$query->the_post();
            if(get_post_type() == 'post'):
        ?>
        	<li><h3><a href="<?php the_permalink(); ?>">
        <?php
            the_field('city_name');
        ?>
        	</a></h3></li>
        <?php
        endif;
        }
        wp_reset_postdata();
        
    ?>
    </ul></div>
    <?php
    }
   ?>
</div>
<?php
}


                
get_footer();
?>