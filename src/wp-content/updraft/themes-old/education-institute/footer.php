<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package education-institute
 */
   
$education_institute_footer_section = get_theme_mod('education-institute_footer_section_hideshow','show');
if ($education_institute_footer_section =='show') { ?>

    <!-- footer starts -->
     <footer class="section-padding">
        <div class="container">
            <div class="row clearfix">
                      <?php dynamic_sidebar('education-institute-footer-widget-area'); ?>

            </div>
        </div>
    </footer>
<?php } ?>
    <!-- Copyright -->
    <div class="copyright-area">
        <div class="container">
            <p><?php if( get_theme_mod('education-institute_footer_text') ) : ?>
                        <span><?php echo wp_kses_post( html_entity_decode(get_theme_mod('education-institute_footer_text'))); ?></span>
                <?php else : 
                    /* translators: 1: poweredby, 2: link, 3: span tag closed  */
                    printf( esc_html__('%1$sPowered by %2$s%3$s','education-institute'),'<span>','<a href="'. esc_url( __( 'https://wordpress.org/','education-institute')).'"target="_blank">"'.esc_html__('WordPress','education-institute'). '"</a>','</span>');
                    /* translators: 1: poweredby, 2: link, 3: span tag closed  */
                    printf( esc_html__( ' Theme: powered by:WordPress %1$sDesign By %2$s%3$s', 'education-institute' ), '<span>', '<a href="'. esc_url( __( 'https://wordpress.org/', 'education-institute' ) ) .'" target="_blank">"'.esc_html__('WordPress','education-institute').'"</a>', '</span>' );
                endif;  ?></p>
        </div>
    </div>
    <!-- footer ends -->
    <?php wp_footer(); ?>
</div>	
</body>
</html>