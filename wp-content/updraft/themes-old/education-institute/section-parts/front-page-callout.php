 <?php 
// To display Footer Call Out section on front page
?>
<?php
$education_institute_contact_section_hideshow = get_theme_mod('education-institute_contact_section_hideshow','hide');
if ($education_institute_contact_section_hideshow =='show') { ?>
<?php $education_institute_callout_btn_text = get_theme_mod('education-institute_callout_btn_text'); ?> 
<?php $education_institute_callout_btn_url = get_theme_mod('education-institute_callout_btn_url'); ?> 


    <!-- callout starts -->
    
    <section class="colaud-area p-tb-60">
        <div class="color-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('education-institute_callout_heading')); ?></h2>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <?php if (!empty($education_institute_callout_btn_url)) { ?>
                        <div class="colaud-btn p-t-20">
                             <a href="<?php echo esc_url($education_institute_callout_btn_url); ?>" class="dark-btn"><?php echo esc_html($education_institute_callout_btn_text); ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!--callout ends-->
<?php } ?>