
<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package education-institute
 */ 
get_header(); ?>

    <main class="banner-area">
        <div class="inner-baner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="baner-title">
                                <h2><?php echo esc_html__('Page Not Found', 'education-institute') ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php educationhub_breadcrumbs(); ?>

    <!-- Error section starts -->
    <div>  
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="error-info">
                       <h1><?php echo esc_html__( '404', 'education-institute' ); ?></h1>
                       <h2><?php echo esc_html__( 'Oops! That Page Cannot be Found', 'education-institute' ); ?></h2>
                       <p><?php echo esc_html__( 'Sorry , But the page you are looking for does not existing.', 'education-institute' ); ?></p>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div class="error-btn text-center p-b-80">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="update-btn"><?php echo esc_html__( 'BACK TO HOME', 'education-institute' ); ?></a>
    </div>
 <!-- Error section ends -->
 <?php get_footer(); ?>