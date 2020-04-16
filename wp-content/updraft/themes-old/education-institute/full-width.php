<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Use this page template to remove the sidebar from any page.
 * @package education-institute
 */
get_header(); 

?>
<main class="banner-area">
<div class="inner-baner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="baner-title">
					<h2><?php the_title(''); ?></h2>                         
				</div>
			</div>
		</div>
	</div>
</div>
</main>
<?php educationhub_breadcrumbs(); ?>

<!-- fulwidth page  -->
<section class="section-padding">
	<div class="container ">
		<div class="row page-content">
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>
					<div class="col-lg-12">
						<div class="full-width">
							<?php if(has_post_thumbnail()) : ?>
								<?php the_post_thumbnail(); ?>
							<?php endif; ?>
							<?php the_content(); 
							wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'education-institute' ),
									'after'  => '</div>',
								) ); ?>
						</div>
						
							<?php if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif; ?> 
						
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<p><?php esc_html__('Nothing Found', 'education-institute'); ?></p>
			<?php endif; ?>
			<!-- Side-bar -->
		</div>
	</div>
</section>
<!--fullwidth page ends  -->

<?php get_footer(); ?>