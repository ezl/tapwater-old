<?php get_header(); ?>

<?php
		
while ( have_posts() ) :

	the_post();

	if(has_post_thumbnail()){
		the_post_thumbnail('full', array('class' => 'page-hero-image'));
	}
?>

<div class="container">

<?php

	breadcrumbs();
?>
	<h1 class="section-title section-title--bright"><?php the_title(); ?></h1>

<?php

	the_content();

endwhile;
wp_reset_query();


?>

<h3 class="section-title section-title--dark">Select Country</h3>


<section class="continent-country-select">

<div class="continent-country-select__bottom">

<?php

//Show all countries in continent
$category = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id'));   

$category = $category[0]->slug; 

$countries = array();

$query = new WP_Query(array(
	'posts_per_page' => -1,
	'post_type' => 'page',
	'category_name' => $category,
	'orderby' => 'title',
	'order' => 'ASC',
	'post_status' => 'publish'
));

if($query->have_posts()):

	echo '<ul>';

	while($query->have_posts()):

		$query->the_post();

		$c = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id')); 

		//Remove usa states from the North America country list

		if(!$c[2]){
			echo '<li><a href="'.get_permalink().'">'.get_field('country_name').'</a></li>';
			$countries = array_merge( $countries, array( get_field('country_name') => get_permalink() ) );
		}		

		//populate array for the select field
			
		
	endwhile;

	echo '</ul>';

endif;

wp_reset_postdata();

?>

</div>

<div class="continent-country-select__top">

	<select name="country-select" id="country-select" onchange="javascript:location.href = this.value;">
	<option value="">-- Select a country --</option>
		<?php
			foreach($countries as $country_name => $country_link){
				if($country_name){
					echo '<option value="'.$country_link.'">'.$country_name.'</option>';
				}
				
			}
		?>
		
	</select>
</div>

</section>

</div>

<?php get_footer(); ?>