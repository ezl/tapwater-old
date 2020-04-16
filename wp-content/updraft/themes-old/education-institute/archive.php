<?php 
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package education-institute
 */
get_header(); 

?>
    <!--======  banner ====== -->

    <main class="banner-area">
        <div class="inner-baner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="baner-title">
                           <h2><?php the_archive_title(); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php educationhub_breadcrumbs(); ?>

    <!-- page  -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php if(have_posts()) : ?>
                        <?php while(have_posts()) : the_post(); ?>
                            <article class="col-md-12 blog-wrap blog-iso-item">
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                   <?php get_template_part('content-parts/content', get_post_format()); ?>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    <?php else : 
                        get_template_part( 'content-parts/content', 'none' );
                    endif; ?>
                    <div class="pagi">
                         <?php the_posts_pagination(
                             array(
                                  'prev_text' => esc_html__('Prev','education-institute'),
                                  'next_text' => esc_html__('Next','education-institute')
                            )
                        ); ?>
                    </div>
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