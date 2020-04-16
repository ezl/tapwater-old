<?php
/**
 * Template part - Service Section of FrontPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package education-institute
 */
    $education_institute_services_section = get_theme_mod( 'education-institute_services_section_hideshow','hide');
    $education_institute_services_title   =  get_theme_mod('education-institute_services_title');  
    $education_institute_column_layout       = get_theme_mod( 'education_institute_column_layout', '4' ); 
   
    $education_institute_services_no        = 6;
    $education_institute_servicepage      = array();
    
    for( $i = 1; $i <= $education_institute_services_no; $i++ ) {
        $education_institute_servicepage[]    =  get_theme_mod( "education_institute_service_page_$i", 1 );
    }

    $education_institute_services_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $education_institute_servicepage ),
        'posts_per_page' => absint($education_institute_services_no),
        'orderby' => 'post__in'
    ); 
    
    $education_institute_services_query = new wp_Query( $education_institute_services_args );
     
     if( $education_institute_services_section == "show") :
    
?>

    <!-- Start service -->
    <section class="facilities-section p-t-80 p-b-50">
        <div class="container">
            <div class="section-header text-center">
                <?php if($education_institute_services_title != "")   {  ?>
                        <h2 class="section-title"><?php echo esc_html($education_institute_services_title); ?>
                          <span class="title-sep grey-sep"></span>
                        </h2>
                <?php } ?>
                        <p class="sub-title"> <?php echo esc_html(get_theme_mod('education-institute_services_subtitle')); ?></p>
            </div>
            <div class="row">
                <?php
                if($education_institute_services_query->have_posts()):
                    $count = 0;
                    while($education_institute_services_query->have_posts()) :
                        $education_institute_services_query->the_post(); ?>
                
                        <!-- item -->
                        <div class="col-md-<?php echo esc_attr($education_institute_column_layout); ?>">
                            <div class="service-box text-center">
                                <?php if(has_post_thumbnail()) : ?>
                                    <div class="service-img">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="service-description">
                                    <h3>
                                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                
                       <?php
                       $count = $count + 1;
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?> 
            </div>
        </div>
    </section>
    <!--services ends -->
<?php endif; ?>