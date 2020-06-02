<?php

/*
 Template Name: USA City Page
 Template Post Type: post
*/

get_header(); 

global $post;

$currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id')); 
$continent_name = $currentcat[0]->name;
$continent_slug = $currentcat[0]->slug;
$country_name = $currentcat[1]->name;
$country_slug = $currentcat[1]->slug;
$countryID = $currentcat[1]->term_id;
$state_name = $currentcat[2]->name;
$state_slug = $currentcat[2]->slug;


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
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

        <?php 
        
		// Start the loop.
		while ( have_posts() ) :
			the_post();
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
		
		?>
    
	<figure class="wp-block-table aligncenter is-style-stripes table-1">
    
    <table>
        
        <tbody>
    <?php
        if(get_field('safe')){
            ?><tr><td>Safe to drink?</td><td class="has-text-align-right table-bool" data-align="right"><?php the_field('safe'); ?></td></tr><?php
        }else if(get_field('water_quality') >= 40){
            ?><tr><td>Safe to drink?</td><td class="has-text-align-right table-bool" data-align="right">Yes</td></tr><?php
        }else if(get_field('water_quality') < 40 && get_field('water_quality') != ''){
            ?><tr><td>Safe to drink?</td><td class="has-text-align-right table-bool" data-align="right">No</td></tr><?php
        }else{
            ?><tr><td>Safe to drink?</td><td class="has-text-align-right table-bool" data-align="right">N/A</td></tr><?php
        }
    ?>
            
    
           <!--/* <tr>
                <td>Passed the WHO International Standard or the EPA Standard?</td>
                <td class="has-text-align-right table-bool" data-align="right"><?php the_field('passed_standard'); ?></td></tr>
            <tr>*/-->
            <?php
            if(get_field('price')){
            ?>
                <td>The estimated price of bottled water in USD(1.5-liter)</td>
                <td class="has-text-align-right" data-align="right">$<?php the_field('price'); ?></td></tr>
            <?php
            }else{
                ?>
                <td>The estimated price of bottled water in USD(1.5-liter)</td>
                <td class="has-text-align-right" data-align="right">N/A</td></tr>
            <?php
            }
            ?>
        
        </tbody>
    
    </table>

</figure>


		<?php
		
		?>
<div class="toc lwptoc"></div>
        <!-- wp:heading -->
<h2>Can You Drink Tap Water in <?php echo the_field('city_name'); ?>?</h2>
<!-- /wp:heading -->

<?php if(get_field('water_quality') >= 40){ ?>
<!-- wp:paragraph -->
<p>Yes, tap water is drinkable.</p>
<!-- /wp:paragraph -->
<?php }
if(get_field('water_quality') < 40 && get_field('water_quality') != ''){ ?>
<!-- wp:paragraph -->
<p>No, tap water is not drinkable.</p>
<!-- /wp:paragraph -->
<?php }?>

<?php if(get_field('water_quality') == ''): ?>
<!-- wp:paragraph -->
<p>Currently, there is no available public data about water quality in <?php the_field('city_name'); ?>. But the average water quality in <?php echo $state_name; ?> is <?php echo get_field('water_quality', $stateID); ?>%.</p>
<!-- /wp:paragraph -->
<?php endif; ?>
<?php
if(get_field('who_national_2017_basic', $stateID)){
?>
<p>According to WHO data, <?php echo get_field('who_national_2017_basic', $stateID); ?>% of <?php echo $state_name; ?> cities/towns and rural areas have access to improved water sources, that are available when needed.
</p>
<?php
}else{
?>
<p>There was no general information available in WHO data about safely managed drinking water in <?php echo $state_name; ?>.</p>
<p>You may check the rate of travelers and residents of <?php the_field('city_name'); ?> water quality.</p>
<?php
}
?>

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

<!-- wp:heading -->
<h2>Tap water by country</h2>
<!-- /wp:heading -->

<?php 

get_template_part('world', 'map'); 

?>
<!-- wp:heading -->
<!--/*
<h2>Current Weather in <?php the_field('city_name'); ?></h2>
*/-->
<!-- /wp:heading -->

<!-- wp:html -->
<!--/*
<a class="weatherwidget-io" href="https://forecast7.com/en/41d9012d50/rome/" data-label_1="ROME" data-label_2="WEATHER" data-font="Ubuntu" data-theme="weather_one">ROME WEATHER</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
*/-->
<!-- /wp:html -->

<!-- wp:heading -->
<h2>How Do People In <?php echo $state_name; ?> Rate The Water?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Travelers and residents of <?php echo $state_name; ?> have rated the water quality and pollution as follows, according to subjective survey data. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>A score of <strong>100%</strong> is considered very high, and a score of <strong>0%</strong> is very low. Please be cautious that <strong>"moderate to very high"</strong> water pollution is bad and the higher the rate of water quality the better.</p>
<!-- /wp:paragraph -->

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
<td class="has-text-align-left" data-align="left"><?php echo $inaccessability; ?>%</td>
<td class="has-text-align-left" data-align="left"><?php echo $drinking_water_pollution_and_inaccessibility_rating; ?></td>
</tr>
<tr>
<td>Water Pollution</td>
<td class="has-text-align-left" data-align="left"><?php echo $waterpollution; ?>%</td>
<td class="has-text-align-left" data-align="left"><?php echo $water_pollution_rating; ?></td>
</tr>
<tr>
<td>Drinking Water Quality and Accessibility</td>
<td class="has-text-align-left" data-align="left"><?php echo $accessibility; ?>%</td>
<td class="has-text-align-left" data-align="left"><?php echo $drinking_water_quality_and_accessibility_rating; ?></td>
</tr>
<tr>
<td>Water Quality</td>
<td class="has-text-align-left" data-align="left"><?php echo $waterquality; ?>%</td>
<td class="has-text-align-left" data-align="left"><?php echo $water_quality_rating; ?></td>
</tr>
</tbody>
</table>
</figure>
<!-- /wp:html -->
<?php if(get_field('ewg_utility_name')): ?>
<div class="ewg">
<h2>Contaminants</h2>
    <div class="ewg__intro">
        <div class="ewg__intro__text">
            
            <h3><?php the_field('ewg_utility_name'); ?></h3>
            <p><?php 
            
                echo urldecode(get_field('ewg_description'));
            
            
            ?></p> 
        </div>
        
    <div class="ewg__intro__utility">
    <h3>Utility details</h3>
        <ul>
            <li><span>Serves: </span><?php the_field('ewg_people'); ?></li>
            <li><span>Data available: </span>2012-2017</li>
            <li><span>Data Source: </span><?php the_field('ewg_data_source'); ?></li>
            <li><span>Total: </span><?php the_field('ewg_total_number'); ?></li>
        </ul>
    </div>
        

    </div>
    <div class="ewg__data">

        <div class="ewg__data__exceed">
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

        <div class="ewg__data__other">
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

    </div>

    <p>Learn more: <a href="<?php the_field('ewg_source'); ?>" target="_blank"><?php the_field('ewg_source'); ?></a></p>

</div>

<?php endif; ?>


<p>
<strong>Reminder:</strong><br/>
Always take extra precautions, the water may be safe to drink when it leaves the sewage treatment plant but it may pick up pollutants during its way to your tap. We advise that you ask locals or hotel staff about the water quality. Also, note that different cities have different water mineral contents.

</p>

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




// Display more cities from same state - usa city page

        
            //only show if not home category post
                              
            
                $query = new WP_Query(array(
                    'category_name' => $state_slug,
                    'post_status' => 'any',
                    'post__not_in' => array(get_the_ID())

                ));
                
                if($query->have_posts() && $query->found_posts > 0):// do not display if only one city in country, because that city  == current city
                    
                    ?>
                    <h3>Check tap water safety for other cities in <a href="<?php echo site_url('/tap-water-safety-in-').$state_slug; ?>"><?php echo $state_name; ?></a></h3>
                    <ul class="country-list">
                    <?php
                    while($query->have_posts()):
                        $query->the_post();
                        if(get_post_type() == 'post')://only show posts - cities
                        ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_field('city_name'); ?></a></li>
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