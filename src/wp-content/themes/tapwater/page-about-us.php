<?php get_header(); ?>

<?php
		
while ( have_posts() ) :

	the_post();

	if(has_post_thumbnail()){
		the_post_thumbnail();
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



</div>

<?php get_footer(); ?>