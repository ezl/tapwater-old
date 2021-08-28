<?php

/*
 Template Name: Country Page
 Template Post Type: page
*/

get_header(); 

if(has_post_thumbnail()){
    the_post_thumbnail('full', array('class' => 'page-hero-image'));
}

global $post;

$currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id')); 
$country_name = $currentcat[1]->name;
$country_slug = $currentcat[1]->slug;
$continent_slug = $currentcat[0]->slug;


//average country water quality
$query = new WP_Query(array(
    'category_name' => $country_slug,
    'post_type' => 'page'
));

if($query->have_posts()){
    
    while($query->have_posts()){
        $query->the_post();
        
        
            
            $countrywaterquality = get_field('water_quality');
            $countrybasicnational2017 = get_field('who_national_2017_basic');
        
    }
}

wp_reset_postdata();

//fetch state page id for water quality data display

$query = new WP_Query(array(
    'category_name' => $state_slug,
    'post_status' => 'any',
    'post_type' => 'page'
));

if($query->have_posts()){
    while($query->have_posts()){
        $query->the_post();
       
            $stateID = get_the_ID();
            
       
    }
}

wp_reset_postdata();



?>
	<div class="container">
		

        <?php 
        
		// Start the loop.
		while ( have_posts() ) :
			the_post();
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

    breadcrumbs();

   
		
	?>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="section-title section-title--bright-left">', '</h1>' );
			else :
				the_title( sprintf( '<h1 class="section-title section-title--bright-left">', esc_url( get_permalink() ) ), '</h1>' );
            endif;
            
//Safe to drink? - based on cdc data or who data

if(get_field('water_quality') >= 40){

    echo '<p class="entry-header__safe"><img src="'. get_template_directory_uri() . '/img/safe-to-drink-yes.jpg"></p>';

}elseif(get_field('water_quality') < 40 && get_field('water_quality') != ''){

    echo '<p class="entry-header__safe"><img src="'. get_template_directory_uri() . '/img/safe-to-drink-no.jpg"></p>';

}else{

    echo '<p class="entry-header__safe"><img src="'. get_template_directory_uri() . '/img/safe-to-drink-maybe.jpg"></p>';

}

			?>
    </header><!-- .entry-header -->
    
    <span class="modified"><span class="modified__text">Last Update</span><?php echo get_the_modified_date('g:i a, F j, Y'); ?></span>

     <hr> 

	<div class="entry-content">

        <section class="intro">

            <div class="intro_side">

                <?php   

                if(get_field('price')){
                ?>
                    <h2>The estimated price of bottled water</h2>
                    <p>$<?php the_field('price'); ?> in USD (1.5-liter)</p>
                <?php
                }else{
                    ?>
                    <h2>The estimated price of bottled water</h2>
                    <p>N/A in USD (1.5-liter)</p>
                
                <?php
                
                }
                ?>

                <?php

if(get_field('drinking_water_pollution_and_inaccessibility')){
    $inaccessability = get_field('drinking_water_pollution_and_inaccessibility');
}else{
    $inaccessability = get_field('drinking_water_pollution_and_inaccessibility', $stateID);
}


if($inaccessability < 20){
    $drinking_water_pollution_and_inaccessibility_rating = 'Very Low';
}elseif($inaccessability >= 20 && $inaccessability < 40){
    $drinking_water_pollution_and_inaccessibility_rating = 'Low';
}elseif($inaccessability >= 40 && $inaccessability < 60){
    $drinking_water_pollution_and_inaccessibility_rating = 'Moderate';
}elseif($inaccessability >= 60 && $inaccessability < 80){
    $drinking_water_pollution_and_inaccessibility_rating = 'High';
}elseif($inaccessability >= 80){
    $drinking_water_pollution_and_inaccessibility_rating = 'Very High';
}


if(get_field('water_pollution')){
    $waterpollution = get_field('water_pollution');
}else{
    $waterpollution = get_field('water_pollution', $stateID);
}

if($waterpollution < 20){
    $water_pollution_rating = 'Very Low';
}elseif($waterpollution >= 20 && $waterpollution < 40){
    $water_pollution_rating = 'Low';
}elseif($waterpollution >= 40 && $waterpollution < 60){
    $water_pollution_rating = 'Moderate';
}elseif($waterpollution >= 60 && $waterpollution < 80){
    $water_pollution_rating = 'High';
}elseif($waterpollution >= 80){
    $water_pollution_rating = 'Very High';
}


if(get_field('drinking_water_quality_and_accessibility')){
    $accessibility = get_field('drinking_water_quality_and_accessibility');
}else{
    $accessibility = get_field('drinking_water_quality_and_accessibility', $stateID);
}

if($accessibility < 20){
    $drinking_water_quality_and_accessibility_rating = 'Very Low';
}elseif($accessibility >= 20 && $accessibility < 40){
    $drinking_water_quality_and_accessibility_rating = 'Low';
}elseif($accessibility >= 40 && $accessibility < 60){
    $drinking_water_quality_and_accessibility_rating = 'Moderate';
}elseif($accessibility >= 60 && $accessibility < 80){
    $drinking_water_quality_and_accessibility_rating = 'High';
}else{
    $drinking_water_quality_and_accessibility_rating = 'Very High';
}


if(get_field('water_quality')){
    $waterquality = get_field('water_quality');
}else{
    $waterquality = get_field('water_quality', $stateID);
}

if($waterquality < 20){
    $water_quality_rating = 'Very Low';
}elseif($waterquality >= 20 && $waterquality < 40){
    $water_quality_rating = 'Low';
}elseif($waterquality >= 40 && $waterquality < 60){
    $water_quality_rating = 'Moderate';
}elseif($waterquality >= 60 && $waterquality < 80){
    $water_quality_rating = 'High';
}else{
    $water_quality_rating = 'Very High';
}



?>


            </div>

            <div class="intro_main">
                <div class="toc"></div>
                        <!-- wp:heading -->
<!-- wp:heading -->
<h2>Can you drink the tap water in <?php the_field('country_name'); ?>?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<?php
if(get_field('cdc_data') !== ''):
    if(get_field('cdc_data') == 'yes'){
?>
<p>The US Center for Disease Control’s travel advisory confirms the safety of the tap water in <?php the_field('country_name'); ?> (<a href="<?php the_field('cdc_source'); ?>">source</a>). However, it would be best if you take special precautions toward the unregulated water sources in some areas.
<?php
}else{
?>
<p>The US Center for Disease Control's travel advisory recommends avoiding tap water and drinking bottled or disinfected water in <?php the_field('country_name'); ?> (<a href="<?php the_field('cdc_source'); ?>">source</a>).
<?php
}
endif;
?>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
Like all countries though, water accessibility, sanitation, and treatment vary widely from location to location, so we encourage looking for specific city information.</p>
<!-- /wp:paragraph -->

<?php
// Travellers Notes

if(get_field('travellers_notes')):

    ?>
    
    <h2>What do people in <?php the_field('country_name'); ?> think about the tap water?</h2>
    

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


<!-- wp:heading -->
<h2>How do People In <?php echo $country_name; ?> Rate The Tap Water?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Travellers and residents of <?php echo $country_name; ?> have rated the water quality and pollution as follows, according to subjective survey data.
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
A score of <strong>100%</strong> is considered very high, and a score of <strong>0%</strong> is very low. Please be cautious that <strong>"moderate to very high"</strong> water pollution is bad and the higher the rate of water quality the better.</p>
<!-- /wp:paragraph -->

<h2>Tap water ratings</h2>
<div class="water-quality-graph">

    <ul>
        <li>
            <span class="water-quality-graph__title">Drinking Water Pollution and Inaccessibility</span>
            <span class="water-quality-graph__container">
                <span class="water-quality-graph__bar inv" data-size="<?php echo $inaccessability; ?>">
                    <span class="water-quality-graph__bar-tooltip"><?php echo $inaccessability.'% '.$drinking_water_pollution_and_inaccessibility_rating; ?><span class="dashicons dashicons-arrow-down"></span></span>
                </span>
            </span>
        </li>
        <li>
            <span class="water-quality-graph__title">Water Pollution</span>
            <span class="water-quality-graph__container">
                <span class="water-quality-graph__bar inv" data-size="<?php echo $waterpollution; ?>">
                    <span class="water-quality-graph__bar-tooltip"><?php echo $waterpollution.'% '.$water_pollution_rating; ?><span class="dashicons dashicons-arrow-down"></span></span>
                </span>
            </span>
        </li>
        <li>
            <span class="water-quality-graph__title">Drinking Water Quality and Accessibility</span>
            <span class="water-quality-graph__container">
                <span class="water-quality-graph__bar" data-size="<?php echo $accessibility; ?>">
                    <span class="water-quality-graph__bar-tooltip"><?php echo $accessibility.'% '.$drinking_water_quality_and_accessibility_rating; ?><span class="dashicons dashicons-arrow-down"></span></span>
                </span>
            </span>
        </li>
        <li>
            <span class="water-quality-graph__title">Water Quality</span>
            <span class="water-quality-graph__container">
                <span class="water-quality-graph__bar" data-size="<?php echo $waterquality; ?>">
                    <span class="water-quality-graph__bar-tooltip"><?php echo $waterquality.'% '.$water_quality_rating; ?><span class="dashicons dashicons-arrow-down"></span></span>
                </span>
            </span>
        </li>
    </ul>

</div>

<script>

(function($){
    
    $(document).ready(function() {
        $('.water-quality-graph__bar').each(function(){
                var $bar=$(this), size=$bar.data('size');
                $bar.width(size+'%').css("background-color", getBackground(size))
        });       
    }); 

    $(document).ready(function() {
        $('.water-quality-graph__bar.inv').each(function(){
                var $bar=$(this), size=$bar.data('size');
                $bar.width(size+'%').css("background-color", getBackgroundInv(size))
        });       
    });    


 function getBackground(e){
    var  color;
     if (e > 0 && e < 33) {
             color= "#950A12";
        } else if (e >= 33 && e < 66) {
            color=  "#F7AF07";
        } else if (e >= 66 && e < 101) {
            color=  "#AFC6A4";
        } 
    return color;

}

 function getBackgroundInv(e){
    var  color;
     if (e > 0 && e < 33) {
             color= "#AFC6A4";
        } else if (e >= 33 && e < 66) {
            color=  "#F7AF07";
        } else if (e >= 66 && e < 101) {
            color=  "#950A12";
        } 
    return color;

}
    
})(jQuery) 

</script>

</div>
</section>



<?php if(get_field('ewg_utility_name')): ?>

<h2 class="section-title section-title--bright">Contaminants</h2>
<hr>

<section class="contaminants">
    
            
            <h3><?php the_field('ewg_utility_name'); ?></h3>
            <p><?php 
            
                echo urldecode(get_field('ewg_description'));
            
            
            ?></p> 
        
        
<div class="contaminants__utility">    
    <h3>Utility details</h3>
        <ul>
            <li><span>Serves: </span><?php the_field('ewg_people'); ?></li>
            <li><span>Data available: </span>2012-2017</li>
            <li><span>Data Source: </span><?php the_field('ewg_data_source'); ?></li>
            <li><span>Total: </span><?php the_field('ewg_total_number'); ?></li>
        </ul>
</div>    
        

    
    

<div class="contaminants__exc">       
        <h3>Contaminants That Exceed Guidelines</h3>
        <ul>
            <?php

                $exceed_contaminants = explode(',', get_field('ewg_exceed'));
                foreach($exceed_contaminants as $n):
                    if($n):
                        ?><li><?php echo $n; ?></li><?php
                    endif;
                endforeach;

            ?>
        </ul>
    </div>         

<div class="contaminants__other">        
        <h3>Other Detected Contaminants</h3>
        <ul>
            <?php

                $other_contaminants = explode(',', get_field('ewg_other'));
                foreach($other_contaminants as $n):
                    if($n):
                        ?><li><?php echo $n; ?></li><?php
                    endif;
                endforeach;

            ?>
        </ul>
    </div>        

    

    



<?php endif; ?>



<h3>Reminder</h3>
<p>
Always take extra precautions, the water may be safe to drink when it leaves the sewage treatment plant but it may pick up pollutants during its way to your tap. We advise that you ask locals or hotel staff about the water quality. Also, note that different cities have different water mineral contents.

</p>
</section>

<?php

if(have_rows('sources') || get_field('ewg_source')):

?>

<h2 class="section-title section-title--bright">Sources and Resources</h2>
    <hr>

    <section class="resources">
<?php

if(have_rows('sources')):

?>
    
    

    <div>
        <h3>Sources</h3>
    <p>
<?php

    while(have_rows('sources')):
        the_row();
?>
    <a href="<?php the_sub_field('source_link'); ?>"><?php the_sub_field('source_link'); ?></a><br>
<?php
    endwhile;
?>
   </p> </div>
<?php
endif;
?>

<?php if(get_field('ewg_source')): ?>


<div>

    <h3>Resources</h3>

<p><a href="<?php the_field('ewg_source'); ?>" target="_blank"><?php the_field('ewg_source'); ?></a></p>

</div>

<?php endif; ?>

</section>

<?php
endif;

if(get_the_content()){
    the_content();
}
if(get_current_user_id() === 4){
// Display more cities from same country - city page

        
            //only show if not home category post
            if(1): 
                //get current categories for post 0-continent 1-country
                
            
                $query = new WP_Query(array(
                    'category_name' => $currentcat[1]->slug,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'post__not_in' => array(get_the_ID())

                ));
                //do not display if only one city in country == current city
                if($query->have_posts() && $query->found_posts > 1):
                    ?>
                    <h3>Check tap water safety for cities in <a href="<?php echo site_url('/tap-water-safety-in-').$currentcat[1]->slug; ?>"><?php echo $currentcat[1]->name; ?></a></h3>
                    <ul class="country-list">
                    <?php
                    while($query->have_posts()):
                        $query->the_post();
                        //only show posts - cities
                        if(get_post_type() == 'post'):
                        ?>
                            <li class="country-list-item"><a href="<?php the_permalink(); ?>"><?php the_field('city_name'); ?></a></li>
                        <?php
                        endif;
                    endwhile;
                    ?>
                    </ul>
                    <?php
                endif;

                wp_reset_postdata();
            endif;
        }      
    

//show more countries in same continent
 
    $query = new WP_Query(array(
        'category_name' => $currentcat[0]->slug,
        'post__not_in' => array(get_the_ID()),
        'orderby' => 'title',
        'order' => 'ASC',
        'post_type' => 'page'
    ));
    
    if($query->have_posts())://do not display if only one city in country  == current city
        if($currentcat[1]->slug == 'united-states-of-america'){

            ?><h3>Check tap water safety of states in the <a href="<?php echo site_url('/').$currentcat[1]->slug; ?>"><?php echo $currentcat[1]->name; ?></a></h3><?php

        }else{

            ?><h3>Check tap water safety for other countries in <a href="<?php echo site_url('/').$currentcat[0]->slug; ?>"><?php echo $currentcat[0]->name; ?></a></h3><?php

        }
        ?>
        
        <ul class="country-list">
        <?php
        while($query->have_posts()):
            $query->the_post();
            
            if(get_field('country_name')):
                ?>
                <li class="country-list-item" data-id="<?php the_ID(); ?>"><a href="<?php the_permalink(); ?>"><?php the_field('country_name'); ?></a></li>
                <?php
            endif;
            
        endwhile;
        ?>
        </ul>
        <?php
    endif;

    wp_reset_postdata();
          
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