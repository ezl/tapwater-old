 <?php 
// To display Blog Post section on front page
?>


<?php  
$education_institute_blog_title =  get_theme_mod('education-institute_blog_title');  
$education_institute_blog_section = get_theme_mod('education-institute_blog_section_hideshow','show');
if ($education_institute_blog_section =='show') { 
?>

   <!-- News-Section -->
    <section class="p-t-80 p-b-60">
        <div class="container">
            <div class="section-header text-center">
                <?php if($education_institute_blog_title !="") { ?>
                    <h2 class="section-title">
                        <?php echo esc_html(get_theme_mod('education-institute_blog_title')); ?>
                        <span class="title-sep grey-sep"></span></span>
                    </h2>
                <?php } ?>
                    <p class="sub-title">
                        <?php echo esc_html(get_theme_mod('education-institute_blog_subtitle')); ?>  
                    </p>
            </div>
            <div class="row">
                <?php $education_institute_latest_blog_posts = new WP_Query( array( 'posts_per_page' => 3 ) );
                    if ( $education_institute_latest_blog_posts->have_posts() ) : 
                        while ( $education_institute_latest_blog_posts->have_posts() ) : $education_institute_latest_blog_posts->the_post(); ?>
                
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="news-box">
								   <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail(); ?>
									<?php endif; ?>
                                    <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                                    <?php the_excerpt() ?>
                                    <a href="<?php the_permalink(); ?>" class="btn-line">
                                    <?php echo esc_html__('Read More', 'education-institute'); ?> 
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                    </a>
                                    <ul class="blog-meta-tag grid-two">
                                        <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><span class="fa fa-user" aria-hidden="true"></span><?php echo esc_html__( 'By', 'education-institute' ); ?> <?php the_author(); ?></a></li>
                                        <li><span class="fa fa-calendar" aria-hidden="true"></span> <?php echo esc_html(get_the_date()); ?></li>
                                    </ul>
                                </div>
                            </div>
                          <?php 
                        endwhile; 
                    endif; ?>
            </div>
        </div>
    </section>
<?php } ?>