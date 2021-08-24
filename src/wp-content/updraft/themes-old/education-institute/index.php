<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
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
                            <?php if (is_home() || is_front_page()) { ?>                        
                                 <h2><?php echo esc_html__('Blog', 'education-institute') ?></h2>
                            <?php } else { ?>
                                <h2><?php the_title(''); ?></h2>                         
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
        <div class="breadcrumbs-area">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php echo esc_html__( 'Home', 'education-institute' ); ?></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php wp_title(''); ?>
                    </li>
                </ul>
            </div>
        </div> 

    <!-- page  -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
				<!-- Side-bar -->
                <div class="col-lg-4">
                    <div class="side-bar">
                        <?php get_sidebar(); ?> 
                    </div>
                </div>
				
				
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
                
            </div>
        </div>
    </section>
    <!-- page ends  -->

<?php get_footer(); ?>