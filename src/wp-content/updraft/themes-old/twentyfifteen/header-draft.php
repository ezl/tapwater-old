<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<meta name="google-site-verification" content="elDfEnNmWenEiX3OoDp3tNl7LPorXjELbb-27k2CyYk" />
</head>
	
<header class="main-header">
   

<div class="contanier">
      <div class="logo"> <a href="https://www.illinois-cannabis-law.com"> <img src="https://www.illinois-cannabis-law.com/wp-content/uploads/2019/09/logo-m.png"> </a></div>
      <div class="search-bar">
         <form role="search" method="get" id="searchform" class="searchform" action="https://www.canyoudrinktapwaterin.com"> <input type="text" class="form-control" name="s" placeholder="Search for city" value=""></form>
      </div>
   </div>
   <div class="menu-bar">
      <div class="contanier">
         <div class="menu_toggle_button" onclick="myFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
         </div>
         <div id="menu_web_view">
            <div class="menu-header-menu-container">
               <ul id="menu-header-menu" class="menu">
                  <li id="menu-item-1107" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1107"><a href="https://www.illinois-cannabis-law.com/illinois-public-act-0027-101st-general-assembly/">LAW TABLE OF CONTENTS</a></li>
                  <li id="menu-item-1106" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1106"><a href="https://www.illinois-cannabis-law.com/links-to-look-up-cannabis-licenses/">HELPFUL RESOURCES</a></li>
                  <li id="menu-item-1167" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1167"><a href="https://www.illinois-cannabis-law.com/laws-amended-by-cannabis-regulation-tax-act/">AMENDED LAWS</a></li>
               </ul>
            </div>
         </div>
         <div id="menu_mobile_view">
            <div class="menu-header-menu-container">
               <ul id="menu-header-menu-1" class="menu">
                  <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1107"><a href="https://www.illinois-cannabis-law.com/illinois-public-act-0027-101st-general-assembly/">LAW TABLE OF CONTENTS</a></li>
                  <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1106"><a href="https://www.illinois-cannabis-law.com/links-to-look-up-cannabis-licenses/">HELPFUL RESOURCES</a></li>
                  <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1167"><a href="https://www.illinois-cannabis-law.com/laws-amended-by-cannabis-regulation-tax-act/">AMENDED LAWS</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
		
			
	


</header><!-- .site-header -->

<body <?php body_class(); ?>>	
<?php wp_body_open(); ?>
	
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyfifteen' ); ?></a>










		<?php get_sidebar(); ?>
	</div><!-- .sidebar -->

	<div id="content" class="site-content">
