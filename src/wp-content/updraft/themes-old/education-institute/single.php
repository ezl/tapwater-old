<?php
/**
 * The template for displaying all single posts.
 *
 * @package education-institute
 */
 get_header(); 

?>
<!-- Page Banner Start -->
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

    <!-- Page Banner End -->
   
    <!-- page  -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php if(have_posts()) : ?>
                        <?php while(have_posts()) : the_post(); ?>
                            <?php  get_template_part( 'content-parts/content', 'single' ); ?>
                        <?php endwhile; ?>
                    <?php else : 
                        get_template_part( 'content-parts/content', 'none' );
                    endif; ?>
                </div>
                <!-- Side-bar -->
                <div class="col-lg-4">
                    <div class="side-bar">
                       <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page ends  -->
<?php get_footer(); ?>