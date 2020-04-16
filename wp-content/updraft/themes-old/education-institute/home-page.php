<?php 
/**
 * Template Name: Home Page
 *
 */

    get_header(); 
    get_template_part( 'section-parts/front-page-banner' );
    get_template_part( 'section-parts/front-page-price' );
    get_template_part( 'section-parts/front-page-thecontent' );
    get_template_part( 'section-parts/front-page-service' );
    get_template_part( 'section-parts/front-page-blogs' );
    get_template_part( 'section-parts/front-page-callout' );
    get_footer();
    ?>