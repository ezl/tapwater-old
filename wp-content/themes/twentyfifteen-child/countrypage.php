<?php

/*
 Template Name: Country Page
*/

get_header(); 
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php

global $post;
$curID = $post->ID;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php


    breadcrumbs();

    
		
		
	?>

	<header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="toc"></div>
	</header><!-- .entry-header -->
<?php
    if($curID == 5233){

get_template_part('usa', 'map'); 

}
?>

	<div class="entry-content">


      
        
<!-- Content -->

<!-- wp:heading -->
<h2>Can you drink the tap water in <?php the_field('country_name'); ?>?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<?php
//drinkable based on cdc data or who data
    if(get_field('cdc_data') != 'no data'){
        if(get_field('cdc_data') == 'yes'){
            echo '<p><strong>In general, yes.</strong></p>';
        }else{
            echo '<p><strong>In general, no.</strong></p>';
        }
    }else if(get_field('who_national_2017_safely_managed') > 90){
        echo '<p><strong>In general, yes.</strong></p>';
    }else if (get_field('who_national_2017_safely_managed') < 20){
        echo '<p><strong>In general, no.</strong></p>';
    }else if(get_field('who_national_2017_safely_managed') > 70 && get_field('who_national_2017_safely_managed') < 90 || !get_field('who_national_2017_safely_managed')){
        echo '<p><strong>We recommend being cautious.</strong></p>';
    }

    

?>

<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<?php
if(get_field('cdc_data') !== ''):
    if(get_field('cdc_data') == 'yes'){
?>
<p>The US Center for Disease Control’s travel advisory confirms the safety of the tap water in <?php the_field('country_name'); ?> (<a href="<?php the_field('cdc_source'); ?>">source</a>). However, it would be best if you take special precautions toward the unregulated water sources in some areas.</p>
<?php
}else{
?>
<p>The US Center for Disease Control's travel advisory recommends avoiding tap water and drinking bottled or disinfected water in <?php the_field('country_name'); ?> (<a href="<?php the_field('cdc_source'); ?>">source</a>).</p>
<?php
}
endif;
?>
<!-- /wp:paragraph -->

<!-- wp:image {"id":4647,"sizeSlug":"large"} -->

<?php twentyfifteen_post_thumbnail(); ?>

<!-- /wp:image -->

<!-- wp:paragraph -->
<p>Like all countries though, water accessibility, sanitation, and treatment vary widely from location to location, so we encourage looking for specific city information.</p>
<!-- /wp:paragraph -->
 
<?php
// Travellers Notes

if(get_field('travellers_notes')):

    ?>
    
    <h2>Local resident's opinion on the tap water quality in their region</h2>
    

    <p><?php the_field('travellers_notes'); ?></p>
    
    <?php

endif;

// Wikitravel

if(get_field('wikitravel_content')):

    ?>
    
    <h2>Wikitravel</h2>
    

    <?php the_field('wikitravel_content'); ?>
    
    <?php

endif;

?>

<?php
// Commonly searched cities

$countrycat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id'));
$query = new WP_Query(array(
    'post_type' => 'post',
    'category_name' => $countrycat[1]->slug,
    'post__not_in' => array(get_the_ID())
));

if($query->have_posts()):

?>
<p>The most commonly searched cities in <?php the_field('country_name'); ?> are:</p>
<?php
echo do_shortcode('[tw_topcities]');
?>
<!-- wp:paragraph -->
<p>For a full list of cities in <?php the_field('country_name'); ?>, scroll to the bottom of this post or click <a href="#bottom">here</a>.</p>
<!-- /wp:paragraph -->
<?php
endif;
wp_reset_postdata();
?>
<!-- /wp:paragraph -->

<?php
    if(get_field('video')):
        the_field('video');
    endif;
?>

<!-- wp:heading -->
<h2>World Health Organization <?php the_field('country_name'); ?> Water Summary</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->


<?php if(get_field('who_national_2017_basic')): ?>
<p>The World Health Organization estimates that <?php the_field('who_national_2017_basic'); ?> percent of <?php the_field('country_name'); ?> have access to drinkable <a href="<?php site_url(); ?>/tap-water/">tap water</a>.</p>
<?php else: ?>
<p>The World Health Organization has unspecified data of information in <?php the_field('country_name'); ?>. You can review below how locals and tourists rated the drinking water in the country. Also, you may ask people from the area with regards to their advice of drinking water, or if skeptical stick with bottled water to ensure safety. 
</p>
<?php endif; ?>

<?php if(get_field('who_national_2000_safely_managed') && get_field('who_national_2000_basic')): ?>
    <p>In 2000, <?php echo get_field('who_national_2000_safely_managed').'%'; ?> of the population had access to drinkable, tap water on site, and <?php echo get_field('who_national_2000_basic').'%'; ?> within an accessible distance, including both rural and urban areas.
    </p>
<?php endif; ?>

<?php if(get_field('who_urban_2017_safely_managed')): ?>
    <p>
    In <?php the_field('country_name'); ?>, like in most countries, clean tap water availability is much higher in urban areas than in rural areas, with urban area availability averages at <?php echo get_field('who_urban_2017_safely_managed').'%'; ?>.
    </p>
<?php endif; ?>

<?php if(get_field('who_rural_2017_safely_managed')): ?>
    <p>
    The rural availability figures at <?php echo get_field('who_rural_2017_safely_managed').'%'; ?>
    </p>
<?php endif; ?>




<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>World Health Organization's 2017 <?php the_field('country_name'); ?> Water Data</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The World Health Organization data on water quality and availability throughout <?php the_field('country_name'); ?> includes the national average, averages for urban population centers, and averages for rural areas.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<figure class="wp-block-table is-style-stripes">
<table class="city-table">
<thead>
<tr>
<th>Data</th>
<th><strong>Description</strong></th>
</tr>
</thead>
<tbody>
<tr>
<td>Safely Managed</td>
<td>A location that safe, drinkable water that is free of biological or chemical contaminants available on premise.</td>
</tr>
<tr>
<td>At Least Basic</td>
<td>Safe drinkable water is available within 30 minutes from the location</td>
</tr>
<tr>
<td>Limited</td>
<td>It would take more than 30 minutes from the location to access safe, drinkable water.</td>
</tr>
</tbody>
</table>
</figure>
<!-- /wp:html -->

<!-- wp:html -->
<figure class="wp-block-table is-style-stripes">
<table class="city-table">
<thead>
<tr>
<th>Year</th>
<th>Population in 1000s</th>
<th>Safely managed</th>
<th>At Least Basic</th>
<th>Limited</th>
</tr>
</thead>
<tbody class="city-table">
<tr>
<td colspan="5"><strong>National</strong></td>
</tr>
<tr>
<td>2000</td>
<td><?php if(get_field('who_national_2000_population')){the_field('who_national_2000_population');}else{echo '-';} ?></td>
<td><?php if(get_field('who_national_2000_safely_managed')){echo get_field('who_national_2000_safely_managed').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_national_2000_basic')){echo get_field('who_national_2000_basic').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_national_2000_limited')){echo get_field('who_national_2000_limited').'%';}else{echo '-';} ?></td>
</tr>
<tr>
<td>2017</td>
<td><?php if(get_field('who_national_2017_population')){echo get_field('who_national_2017_population');}else{echo '-';} ?></td>
<td><?php if(get_field('who_national_2017_safely_managed')){echo get_field('who_national_2017_safely_managed').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_national_2017_basic')){echo get_field('who_national_2017_basic').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_national_2017_limited')){echo get_field('who_national_2017_limited').'%';}else{echo '-';} ?></td>
</tr>
<tr>
<td colspan="5"><strong>Rural</strong></td>
</tr>
<tr>
<td>2000</td>
<td><?php if(get_field('who_rural_2000_population')){echo get_field('who_rural_2000_population');}else{echo '-';} ?></td>
<td><?php if(get_field('who_rural_2000_safely_managed')){echo get_field('who_rural_2000_safely_managed').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_rural_2000_basic')){echo get_field('who_rural_2000_basic').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_rural_2000_limited')){echo get_field('who_rural_2000_limited').'%';}else{echo '-';} ?></td>
</tr>
<tr>
<td>2017</td>
<td><?php if(get_field('who_rural_2017_population')){echo get_field('who_rural_2017_population');}else{echo '-';} ?></td>
<td><?php if(get_field('who_rural_2017_safely_managed')){echo get_field('who_rural_2017_safely_managed').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_rural_2017_basic')){echo get_field('who_rural_2017_basic').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_rural_2017_limited')){echo get_field('who_rural_2017_limited').'%';}else{echo '-';} ?></td>
</tr>
<tr>
<td colspan="5"><strong>Urban</strong></td>
</tr>
<tr>
<td>2000</td>
<td><?php if(get_field('who_urban_2000_population')){echo get_field('who_urban_2000_population');}else{echo '-';} ?></td>
<td><?php if(get_field('who_urban_2000_safely_managed')){echo get_field('who_urban_2000_safely_managed').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_urban_2000_basic')){echo get_field('who_urban_2000_basic').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_urban_2000_limited')){echo get_field('who_urban_2000_limited').'%';}else{echo '-';} ?></td>
</tr>
<tr>
<td>2017</td>
<td><?php if(get_field('who_urban_2017_population')){echo get_field('who_urban_2017_population');}else{echo '-';} ?></td>
<td><?php if(get_field('who_urban_2017_safely_managed')){echo get_field('who_urban_2017_safely_managed').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_urban_2017_basic')){echo get_field('who_urban_2017_basic').'%';}else{echo '-';} ?></td>
<td><?php if(get_field('who_urban_2017_limited')){echo get_field('who_urban_2017_limited').'%';}else{echo '-';} ?></td>
</tr>
</tbody>
</table>
</figure>
<!-- /wp:html -->

<!-- wp:heading -->
<h2>How Do People In <?php the_field('country_name'); ?> Rate The Water?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Travelers and residents of <?php the_field('country_name'); ?> have rated the water quality and pollution as follows, according to subjective survey data.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>A score of <strong>100%</strong> is considered very high, and a score of <strong>0%</strong> is very low. Please be cautious that <strong>"moderate to very high"</strong> water pollution is bad and the higher the rate of water quality the better.</p>
<!-- /wp:paragraph -->

<?php

if(get_field('drinking_water_pollution_and_inaccessibility') < 30){
    $drinking_water_pollution_and_inaccessibility_rating = 'Low';
}else if(get_field('drinking_water_pollution_and_inaccessibility') >= 30 && get_field('drinking_water_pollution_and_inaccessibility') < 65){
    $drinking_water_pollution_and_inaccessibility_rating = 'Moderate';
}else{
    $drinking_water_pollution_and_inaccessibility_rating = 'High';
}

if(get_field('water_pollution') < 30){
    $water_pollution_rating = 'Low';
}else if(get_field('water_pollution') >= 30 && get_field('water_pollution') < 65){
    $water_pollution_rating = 'Moderate';
}else{
    $water_pollution_rating = 'High';
}

if(get_field('drinking_water_quality_and_accessibility') < 30){
    $drinking_water_quality_and_accessibility_rating = 'Low';
}else if(get_field('drinking_water_quality_and_accessibility') >= 30 && get_field('drinking_water_quality_and_accessibility') < 65){
    $drinking_water_quality_and_accessibility_rating = 'Moderate';
}else{
    $drinking_water_quality_and_accessibility_rating = 'High';
}

if(get_field('water_quality') < 30){
    $water_quality_rating = 'Low';
}else if(get_field('water_quality') >= 30 && get_field('water_quality') < 65){
    $water_quality_rating = 'Moderate';
}else{
    $water_quality_rating = 'High';
}

?>

<!-- wp:html -->
<figure class="wp-block-table is-style-stripes">
<table class="wp-block-table is-style-stripes">
<thead class="city-head">
<tr>
<th>Description</th>
<th class="has-text-align-left" data-align="left">Score</th>
<th class="has-text-align-left" data-align="left">Rating</th>
</tr>
</thead>
<tbody class="city-table1">
<tr>
<td>Drinking Water Pollution and Inaccessibility</td>
<td class="has-text-align-left" data-align="left"><?php the_field('drinking_water_pollution_and_inaccessibility'); ?>%</td>
<td class="has-text-align-left" data-align="left"><?php echo $drinking_water_pollution_and_inaccessibility_rating; ?></td>
</tr>
<tr>
<td>Water Pollution</td>
<td class="has-text-align-left" data-align="left"><?php the_field('water_pollution'); ?>%</td>
<td class="has-text-align-left" data-align="left"><?php echo $water_pollution_rating; ?></td>
</tr>
<tr>
<td>Drinking Water Quality and Accessibility</td>
<td class="has-text-align-left" data-align="left"><?php the_field('drinking_water_quality_and_accessibility'); ?>%</td>
<td class="has-text-align-left" data-align="left"><?php echo $drinking_water_quality_and_accessibility_rating; ?></td>
</tr>
<tr>
<td>Water Quality</td>
<td class="has-text-align-left" data-align="left"><?php the_field('water_quality'); ?>%</td>
<td class="has-text-align-left" data-align="left"><?php echo $water_quality_rating; ?></td>
</tr>
</tbody>
</table>
</figure>
<!-- /wp:html -->

<!-- end content -->
        
<?php

if(have_rows('sources')):

?>
    <div class="sources">
    <h2>Sources</h2>
<?php

    while(have_rows('sources')):
        the_row();
?>
    <a href="<?php the_sub_field('source_link'); ?>"><?php the_sub_field('source_link'); ?></a><br>
<?php
    endwhile;
?>
    </div>
<?php
endif;

?>

<?php

the_content();

    $categories = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'names', 'orderby' => 'term_id')); 
if($categories[1])://only show if is country page
	  
    
    $country_name = $categories[1];
//    echo '<h3>View our tap water report on all cities in '.$country_name.'</h3>';
//    echo '<ul class="country-list">';
    $query = new WP_Query(array(
    	'post_type' => 'post',
        'category_name' => $country_name,
        'post__not_in' => array(get_the_ID())
    ));
if($query->have_posts()):
    echo '<h3>View our tap water report on all cities in '.$country_name.'</h3>';
    echo '<ul class="country-list">';
    while($query->have_posts()):
    $currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'names', 'orderby' => 'term_id')); 
    	$query->the_post();
    if(get_post_type() == 'post' && $currentcat[1]):
        echo '<li><a href="'.get_permalink().'">'.get_field('city_name').'</a></li>';
        endif;
    endwhile;

endif;
    
    echo '</ul>';
    
    wp_reset_postdata();
    ?>
<a name="bottom"></a>
    <?php
    //show more countries in same continent
    
    $continent_name = $categories[0];
    
    $query = new WP_Query(array(
    	'post_type' => 'page',
        'category_name' => $continent_name,
        'post__not_in' => array(5233)
    ));
    if($query->have_posts()):
    echo '<h3>View other countries in '.$continent_name.'</h3>';
    echo '<ul class="country-list">';
    while($query->have_posts()):
    	$query->the_post();
        $currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'names', 'orderby' => 'term_id'));
        
        //if usa
        if(get_post_type() == 'page' && $currentcat[2] && $curID != get_the_ID()){
       echo '<li><a href="'.get_the_permalink().'">'.$currentcat[2].'</a></li>';
        }
        //if non usa
        if(get_post_type() == 'page' && $currentcat[1] && $curID != get_the_ID() && $currentcat[1] != 'United States of America'){
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

</main><!-- .site-main -->
	</div><!-- .content-area -->
<script>
(function($){
    
    $('.toc').append('<p class="toc-title">Table of Contents</p>');

    function toc(){
    $('.entry-content h2').each(function(i){

        $(this).attr('id', 'title-'+i);
        $('.toc').append('<a class="toc-item" href="#title-'+i+'">'+(i+1)+' '+$(this).text()+'</a>');

    });    
    
    }
    toc();
    
    

    

    
   
})(jQuery)
</script>
<?php get_footer(); ?>