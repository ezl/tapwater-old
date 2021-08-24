<?php
/**
 * Template part - Intro Section of FrontPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package education-institute
 */


$education_institute_image_section_hideshow = get_theme_mod("education_institute_section_choice_option",'hide');
$education_institute_image_more = get_theme_mod("education-institute_image_more",'');
$education_institute_image_more_url = get_theme_mod("education-institute_image_more_url",'');

$education_institute_b_image = get_theme_mod("education-institute_b_image",''); 
$education_institute_image_heading = get_theme_mod("education-institute_image_heading",'');

if( $education_institute_image_section_hideshow == "show") :
?>

<!-- main section start-->
    <main>
        <div class="hero-img" style="background: url('<?php echo esc_url($education_institute_b_image); ?>') no-repeat center center; ">
            <div class="container text-center">
                <div class="inner-home">
                    <?php if ($education_institute_image_heading !=""){ ?>
                    <h1 class="home-title"><?php echo esc_html($education_institute_image_heading); ?>
                    </h1>
                    <?php } ?>
                    <h3 class="home-sub-title"><?php echo esc_html(get_theme_mod('education-institute_image_subheading')); ?></h3>
                    <?php if (!empty($education_institute_image_more_url)) { ?>
                        <a href="<?php echo esc_url($education_institute_image_more_url); ?>" class="home-btn-two hover-btn" data-wow-delay="0.39s"><?php echo esc_html($education_institute_image_more); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <!-- main section end-->
    <?php
    endif;
?>

<?php if ($education_institute_image_section_hideshow == 'hide'){ ?>
    <main class="banner-area">
        <div class="inner-baner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="baner-title">
                            <?php if (is_home() || is_front_page()) { ?>                        
                                 <h2><?php echo esc_html__('Home', 'education-institute') ?></h2>
                            <?php } else { ?>
                                <h2><?php wp_title(''); ?></h2>                         
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
     <?php } ?>