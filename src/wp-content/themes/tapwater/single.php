<?php 

if (!has_category('home')){

    //city posts

?>

<?php

get_header(); 

if(has_post_thumbnail()){
    the_post_thumbnail('full', array('class' => 'page-hero-image'));
}

?>

<div class="container">
	
		<?php

breadcrumbs();

		// Start the loop.
		while ( have_posts() ) :

			the_post();		
			
?>

<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="section-title section-title--bright-left">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            endif;
            
            
            ?>
            
            <?php
        if(get_field('safe')){
            echo '<p class="entry-header__safe"><img src="'. get_template_directory_uri() . '/img/safe-to-drink-yes.jpg"></p>';
        }elseif(get_field('water_quality') >= 40){
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

	<div class="toc"></div>

<?php

			the_content();

		endwhile;
		
		?>
		<?php if(get_field('ebmed_code_id')) { ?>
            <div><script src="https://www.airbnb.com/embeddable/airbnb_jssdk" async=""></script><div class="airbnb-embed-frame" data-view="a4p_event_embeddable" data-id="<?php the_field('ebmed_code_id'); ?>" data-height="750" style="height:750px"></div></div>
        <?php } ?>	

	</div>		
	</div>		



<?php 

get_footer(); 

?>

<?php

    
    
}else{

    // posts in home category

    ?>

<?php

get_header(); 

if(has_post_thumbnail()){
    the_post_thumbnail('full', array('class' => 'page-hero-image'));
}

?>

<div class="container">
	
		<?php

breadcrumbs();

		// Start the loop.
		while ( have_posts() ) :

			the_post();		
			
?>

<header class="entry-header" style="display:block;">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="section-title section-title--bright">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            endif;
            
            
            ?>
            
            

	</header><!-- .entry-header -->
	
    <span class="modified"><span class="modified__text">Last Update</span><?php echo get_the_modified_date('g:i a, F j, Y'); ?></span>

	<hr> 
	
	<div class="entry-content">

	

<?php

			the_content();

		endwhile;
		
		?>

	</div>		
	</div>		

	<script>
(function($){
    
    $('.toc').append('<h3>Table of Contents</h3>');

    function toc(){
    $('.entry-content h2').each(function(i){

        $(this).attr('id', 'title-'+i);
        $('.toc').append('<a class="toc-item" href="#title-'+i+'">'+(i+1)+') '+$(this).text()+'</a>');

    });  

    
    
    }

    toc();
    
    

    

    
   
})(jQuery)
</script>

<?php 

get_footer(); 

?>

    <?php

}

?>

