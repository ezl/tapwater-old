<?php

/*
 Template Name: State Page
 Template Post Type: page
*/

get_header(); 

global $post;

$currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id')); 
$country_name = $currentcat[1]->name;
$country_slug = $currentcat[1]->slug;

//average country water quality
$query = new WP_Query(array(
    'category_name' => $country_slug,
    
));

if($query->have_posts()){
    while($query->have_posts()){
        $query->the_post();
        if(get_post_type() == 'page'){
            $countrywaterquality = get_field('water_quality');
            $countrybasicnational2017 = get_field('who_national_2017_basic');
        }
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
		if(get_field('price')){
		?>
    <!--/*
	<figure class="wp-block-table aligncenter is-style-stripes table-1">
    
    <table>
        
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

</figure>*/-->


		<?php
		}
		?>
<div class="toc lwptoc"></div>
        <!-- wp:heading -->
<h2>Can You Drink Tap Water in <?php echo the_field('country_name'); ?>?</h2>
<!-- /wp:heading -->

<?php if(get_field('water_quality') >= 40): ?>
<!-- wp:paragraph -->
<p>Yes, tap water is drinkable.</p>
<!-- /wp:paragraph -->
<?php endif; ?>
<?php if(get_field('water_quality') < 40 && get_field('water_quality') !== ''): ?>
<!-- wp:paragraph -->
<p>No, tap water is not drinkable.</p>
<!-- /wp:paragraph -->
<?php endif; ?>
<?php if(!get_field('water_quality')): ?>
<!-- wp:paragraph -->
<p>Currently, there is no available public data about water quality in <?php the_field('country_name'); ?>. But the average water quality in <?php echo $country_name; ?> is <?php echo $countrywaterquality; ?>%.</p>
<!-- /wp:paragraph -->
<?php endif; ?>
<?php
if($countrybasicnational2017){
?>
<p>According to WHO data, <?php echo $countrybasicnational2017; ?>% of <?php echo $country_name; ?> cities/towns and rural areas have access to improved water sources, that are available when needed.
</p>
<?php
}else{
?>
<p>There was no general information available in WHO data about safely managed drinking water in <?php the_field('country_name'); ?>.</p>
<p>You may check the rate of travelers and residents of <?php the_field('city_name'); ?> water quality.</p>
<?php
}
?>

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
<h2>Tap water by country</h2>
<!-- /wp:heading -->

<?php get_template_part('world', 'map');  ?>

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
<h2>What Do People In <?php the_field('country_name'); ?> Think About The Tap Water?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Travelers and residents of <?php the_field('country_name'); ?> have rated the water quality and pollution as follows, according to subjective survey data. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>A score of <strong>100%</strong> is considered very high, and a score of <strong>0%</strong> is very low. Please be cautious that <strong>"moderate to very high"</strong> water pollution is bad and the higher the rate of water quality the better.</p>
<!-- /wp:paragraph -->

<?php

if(get_field('drinking_water_pollution_and_inaccessibility') < 20){
    $drinking_water_pollution_and_inaccessibility_rating = 'Very Low';
}elseif(get_field('drinking_water_pollution_and_inaccessibility') >= 20 && get_field('drinking_water_pollution_and_inaccessibility') < 40){
    $drinking_water_pollution_and_inaccessibility_rating = 'Low';
}elseif(get_field('drinking_water_pollution_and_inaccessibility') >= 40 && get_field('drinking_water_pollution_and_inaccessibility') < 60){
    $drinking_water_pollution_and_inaccessibility_rating = 'Moderate';
}elseif(get_field('drinking_water_pollution_and_inaccessibility') >= 60 && get_field('drinking_water_pollution_and_inaccessibility') < 80){
    $drinking_water_pollution_and_inaccessibility_rating = 'High';
}elseif(get_field('drinking_water_pollution_and_inaccessibility') >= 80){
    $drinking_water_pollution_and_inaccessibility_rating = 'Very High';
}

if(get_field('water_pollution') < 20){
    $water_pollution_rating = 'Very Low';
}elseif(get_field('water_pollution') >= 20 && get_field('water_pollution') < 40){
    $water_pollution_rating = 'Low';
}elseif(get_field('water_pollution') >= 40 && get_field('water_pollution') < 60){
    $water_pollution_rating = 'Moderate';
}elseif(get_field('water_pollution') >= 60 && get_field('water_pollution') < 80){
    $water_pollution_rating = 'High';
}elseif(get_field('water_pollution') >= 80){
    $water_pollution_rating = 'Very High';
}



if(get_field('drinking_water_quality_and_accessibility') < 20){
    $drinking_water_quality_and_accessibility_rating = 'Very Low';
}elseif(get_field('drinking_water_quality_and_accessibility') >= 20 && get_field('drinking_water_quality_and_accessibility') < 40){
    $drinking_water_quality_and_accessibility_rating = 'Low';
}elseif(get_field('drinking_water_quality_and_accessibility') >= 40 && get_field('drinking_water_quality_and_accessibility') < 60){
    $drinking_water_quality_and_accessibility_rating = 'Moderate';
}elseif(get_field('drinking_water_quality_and_accessibility') >= 60 && get_field('drinking_water_quality_and_accessibility') < 80){
    $drinking_water_quality_and_accessibility_rating = 'High';
}else{
    $drinking_water_quality_and_accessibility_rating = 'Very High';
}

if(get_field('water_quality') < 20){
    $water_quality_rating = 'Very Low';
}elseif(get_field('water_quality') >= 20 && get_field('water_quality') < 40){
    $water_quality_rating = 'Low';
}elseif(get_field('water_quality') >= 40 && get_field('water_quality') < 60){
    $water_quality_rating = 'Moderate';
}elseif(get_field('water_quality') >= 60 && get_field('water_quality') < 80){
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

//show more countries in same continent

    $query = new WP_Query(array(
        'category_name' => $currentcat[1]->slug,
        'post_type' => 'page',
        'post_status' => 'any',
        'post__not_in' => array(get_the_ID())

    ));

    
    
    if($query->have_posts())://do not display if only one city in country, because that city  == current city
        ?>
        <h3>Check tap water safety for other states in <a href="<?php echo site_url('/tap-water-safety-in-').$currentcat[1]->slug; ?>"><?php echo $currentcat[1]->name; ?></a></h3>
        <ul class="country-list">
        <?php
        while($query->have_posts()):
            $query->the_post();
            if(get_post_type() == 'page' && get_the_ID() != 5233):
            ?>
               <li><a href="<?php the_permalink(); ?>"><?php the_field('country_name'); ?></a></li>
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