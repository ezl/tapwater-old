<?php 
/**
 * The header for our theme.
 *
 * Displays all of the <head> section 
 *
 * @package education-institute
 */
 ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
 <?php endif; ?>

  <?php wp_head(); ?>
</head> 
<body <?php body_class(); ?>>
<?php
wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-institute' ); ?></a>

    <!-- preloader -->
     <div class="preloader">
        <div class="loader">
            <div class="loader-inner">
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
            <div class="loader-inner box box-1">
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
            <div class="loader-inner box box-2">
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
            <div class="loader-inner box box-3">
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
            <div class="loader-inner box box-4">
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
            <div class="loader-inner box box-5">
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
            <div class="loader-inner box box-6">
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
            <div class="loader-inner">
                <hr>
                <hr>
                <hr>
                <hr>
                <hr>
            </div>
        </div>
    </div>

   <!-- header starts -->
   <header>
        <?php  
        $education_institute_header_section = get_theme_mod('education-institute_header_section_hideshow' ,'show');
        if ($education_institute_header_section =='show') { 
                $education_institute_phone_value = get_theme_mod('education-institute_header_phone_value');
                $education_institute_social_link_1 = get_theme_mod('education-institute_header_social_link_1');
                $education_institute_social_link_2 = get_theme_mod('education-institute_header_social_link_2');
                $education_institute_social_link_3 = get_theme_mod('education-institute_header_social_link_3');
                $education_institute_social_link_4 = get_theme_mod('education-institute_header_social_link_4');
            ?>
            
            <!-- topbar -->
                <div class="header-top bg-theme">
                    <div class="top-bar">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <?php if (has_custom_logo()) : ?> 
                                        <div class="theme-logo">
                                             <?php the_custom_logo(); ?>
                                        </div>
                                    <?php  else : ?>
                                        <div class="theme-logo">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                <h3 class="site-title"><?php bloginfo( 'title' ); ?></h3>
                                                <span class="site-description"><?php bloginfo( 'description' ); ?></span>
                                            </a> 
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="top-widget">
                                        <ul class="right-bor">
                                            <?php if (!empty($education_institute_phone_value)) { ?>
                                                <li>
                                                    <span>
                                                      <i class="fa fa-phone" aria-hidden="true"></i>
                                                    </span><?php echo esc_html__( 'call Us:', 'education-institute' ); ?>  <?php echo esc_html($education_institute_phone_value); ?>
                                                </li>
                                            <?php } ?>
                                            <?php if(!empty($education_institute_social_link_1) or !empty($education_institute_social_link_2) or !empty($education_institute_social_link_3) or !empty($education_institute_social_link_4)) { ?>
                                                <li>
                                                    <ul class="social-top-widget">
                                                        <li>
                                                            <?php 
                                                                if (!empty($education_institute_social_link_1)) { ?>
                                                                    <a href="<?php echo esc_url($education_institute_social_link_1); ?>">
                                                                         <i class="fa fa-facebook" aria-hidden="true"></i>
                                                                    </a>
                                                            <?php } ?>
                                                        </li>
                                                        <li>
                                                            <?php 
                                                                if (!empty($education_institute_social_link_2)) { ?>
                                                                <a href="<?php echo esc_url($education_institute_social_link_2); ?>">
                                                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </li>
                                                        <li>
                                                            <?php 
                                                                if (!empty($education_institute_social_link_3)) { ?>
                                                                <a href="<?php echo esc_url($education_institute_social_link_3); ?>">
                                                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </li>
                                                        <li>
                                                            <?php 
                                                                if (!empty($education_institute_social_link_4)) { ?>
                                                                <a href="<?php echo esc_url($education_institute_social_link_4); ?>">
                                                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                            <li class="search-widget">
												<form role="search" method="get" class="search-form" action="https://www.canyoudrinktapwaterin.com/">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" placeholder="Search banna …" value="" name="s">
				</label>
				<input type="submit" class="search-submit" value="Search">
			</form>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
        <?php } ?>
                <!-- menu -->
                <div class="main-menu header-sticky clearfix">
                    <div class="container">
                        <div class="pos-relative">
                            <div class="row">
                                <div class="col-lg-12">
                                    <nav class="navbar navbar-expand-lg">
                                        <!-- Links -->
                                        <div class="collapse navbar-collapse" id="nav-content">
                                            <?php wp_nav_menu( 
                                                array(
                                                    'container'        => 'ul', 
                                                    'theme_location'    => 'primary', 
                                                    'menu_class'        => 'menu', 
                                                    'items_wrap'        => '<ul class="navbar-nav" id="main-menu">%3$s</ul>',
                                                    'fallback_cb'       => 'education_institute_wp_bootstrap_navwalker::fallback',
                                                    'walker'            => new education_institute_wp_bootstrap_navwalker()
                                                )
                                            ); ?>
                                        </div>
                                    </nav>
                                    <?php  
                                     $education_institute_button_section = get_theme_mod('education-institute_quote_section_hideshow' ,'show');
                                        if ($education_institute_button_section =='show') { 
                                            $education_institute_ctah_btn1_text = get_theme_mod('education-institute_ctah_btn1_text');
                                            $education_institute_ctah_btn1_url = get_theme_mod('education-institute_ctah_btn1_url'); ?>
                                        
                                            <div class="login-box">
                                                <ul>
                                                    <?php if (!empty($education_institute_ctah_btn1_url)) { ?> 
                                                            <li>
                                                                <a href="<?php echo esc_url($education_institute_ctah_btn1_url); ?>" class="box-btn"><?php echo esc_html($education_institute_ctah_btn1_text); ?></a>
                                                            </li>
                                                        <?php } ?>
                                                </ul>
                                            </div>
                                    <?php } ?>
                                    <div class="mobile-menu"> </div>
                                </div>
                           </div>
                        </div>
                    </div>
               </div>
    </header>
	<div id="content">