<?php
/**
 * The main template file
 * @package Openness
 */
 
$blogstyle = esc_attr(get_theme_mod( 'openness_blog_style', 'blog-standard' ));

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main <?php echo esc_attr($blogstyle); ?>">
	
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'banner' ); ?>
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'breadcrumbs' ); ?>
	

<?php if ( $blogstyle == 'blog-card')  : ?>

	<?php if ( have_posts() ) : ?>
		<?php if ( is_archive() ) : ?>
				<header class="page-header">
					<?php
					 if ( esc_attr(get_theme_mod( 'openness_show_archive_labels', true ) ) ) :
						openness_archive_title( '<h1 class="page-title">', '</h1>' );
					else: 
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					endif;					
						the_archive_description( '<div class="category-description">', '</div>' );
					?>
				</header><!-- .page-header -->	
		<?php endif; ?>	
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>
			<div id="blog-card">
			<div class="container-fluid">
			<div class="row row-eq-height  no-gutters">
			<?php	
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/post/content', 'cards' );
			endwhile;
				
			else :
				get_template_part( 'content', 'none' );
			endif; 
			?>
		</div>
		</div>
		</div>
		<?php get_template_part( 'template-parts/navigation/navigation', 'blog' ); ?>

<?php else : ?>

	<?php if ( have_posts() ) : ?>
		<?php if ( is_archive() ) : ?>
				<header class="page-header">
					<?php
					 if ( esc_attr(get_theme_mod( 'openness_show_archive_labels', true ) ) ) :
						openness_archive_title( '<h1 class="page-title">', '</h1>' );
					else: 
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					endif;
						the_archive_description( '<div class="category-description">', '</div>' );
					?>
				</header><!-- .page-header -->	
		<?php endif; ?>	
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>
		<div id="blog-standard">
			<?php	
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );
			endwhile;
				get_template_part( 'template-parts/navigation/navigation', 'blog' );
			else :
				get_template_part( 'content', 'none' );
			endif; 
			?>
		</div>
		
<?php endif; ?>


<?php get_template_part( 'template-parts/sidebars/sidebar', 'bottom' ); ?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>