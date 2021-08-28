<?php

get_header();

?>

<div class="container">
<h1 class="section-title section-title--bright"><?php wp_title(); ?></h1>
<hr>

<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$query = new WP_query(array(
	'posts_per_page' => 15,
        'post_type' => 'post',
        'meta_key'			=> 'water_quality',
        'meta_value'  => 0,
        'meta_compare' => '>',
        'orderby'			=> 'meta_value_num',
        'order'				=> 'ASC',
        'paged' => $paged
));

if($query->have_posts()){

    while($query->have_posts()){
        
        $query->the_post();

		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header class="entry-header">
		<a href="<?php the_permalink(); ?>"><h2 class="section-title section-title--bright-left blog-title"><?php the_title(); ?></h2></a>
		</header><!-- .entry-header -->
		
		<div class="entry-content">
		<?php 
		
		if(get_the_excerpt()){
			the_excerpt();
		}else{
			wp_trim_words(get_the_content(), 60, '...');
		}
		
		?>
		
		</div>
		
		</article>
				<?php

    }

    ?>

    <div class="paginate">
				<?php 
					echo paginate_links( array(
						'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
						'total'        => $query->max_num_pages,
						'current'      => max( 1, get_query_var( 'paged' ) ),
						'format'       => '?paged=%#%',
						'show_all'     => false,
						'type'         => 'plain',
						'end_size'     => 2,
						'mid_size'     => 1,
						'prev_next'    => true,
						'prev_text'    => __( '&laquo; Previous' ),
        				'next_text'    => __( 'Next &raquo;' ),
						'add_args'     => false,
						'add_fragment' => '',
					) );
				?>
	</div>
</div>

    <?php
}

wp_reset_postdata();

get_footer();

?>