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
	
	<!-- Pinterest -->
	<meta name="p:domain_verify" content="54e535c714e6639a2c0750a90fc3c5bf"/>
	<!-- Pinterest -->
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	
		<script data-ad-client="ca-pub-2648095472405229" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

	
	<?php 
	
	
	//custom meta description
	//cities

	$currentcat = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id')); 
	$country_name = $currentcat[1]->name;
	$state_name = $currentcat[2]->name;
	($state_name) ? $parent_id = $currentcat[2]->term_id : $parent_id = $currentcat[1]->term_id;
	
	$query = new WP_Query([
		'post_type' => 'page',
		'cat' => $parent_id
	]);
	while($query->have_posts()){
		$query->the_post();
		$parent_water_quality = get_field('water_quality', get_the_ID());
	}
	wp_reset_postdata();
	

	if(get_post_type(get_the_ID()) == 'post'): 
		if(get_field('water_quality') >= 40){
			$meta_desc_data = 'Yes! '.get_field('city_name').' tap water IS safe to drink. People in '.get_field('city_name').' rate the Water Quality with a '.get_field('water_quality').' score out of 100. Check out other information about tap water quality in '.get_field('city_name').'.';
		}
		elseif(get_field('water_quality') < 40 && get_field('water_quality') != ''){
			$meta_desc_data = 'No! '.get_field('city_name').' tap water is NOT safe to drink. People in '.get_field('city_name').' rate the Water Quality with a '.get_field('water_quality').' score out of 100. Check out other information about tap water quality in '.get_field('city_name').'.';
		}elseif(get_field('water_quality') == ''){
			($state_name) ? $parent = $state_name : $parent = $country_name;
			$meta_desc_data = 'Maybe. '.get_field('city_name').' tap water should be consumed with caution. There is currently no information about the water quality in '.get_field('city_name').'. But the water quality in '.$parent.' has a general rating of '.$parent_water_quality.' out of 100. Check out other information about tap water quality in '.get_field('city_name');
		}
	endif;

	//countries and states
	
	if(get_post_type(get_the_ID()) == 'page'): 
		if(get_field('water_quality') >= 40){
			$meta_desc_data = 'Yes! '.get_field('country_name').' tap water IS safe to drink. People in '.get_field('country_name').' rate the Water Quality with a '.get_field('water_quality').' score out of 100. Check out other information about tap water quality in '.get_field('country_name').'.';
		}
		elseif(get_field('water_quality') < 40 && get_field('water_quality') != ''){
			$meta_desc_data = 'No! '.get_field('country_name').' tap water is NOT safe to drink. People in '.get_field('country_name').' rate the Water Quality with a '.get_field('water_quality').' score out of 100. Check out other information about tap water quality in '.get_field('country_name').'.';
		}elseif(get_field('water_quality') == ''){
			($state_name) ? $parent = $state_name : $parent = $country_name;
			$meta_desc_data = 'Maybe. '.get_field('country_name').' tap water should be consumed with caution. There is currently no information about the water quality in '.get_field('country_name');
		}
	endif;

	// if ordinary page - not country, state, etc
	
	if(!$country_name):
		$meta_desc_data = get_bloginfo('name').' - '.get_the_title();
	endif;

	

	?>
		<meta name="description" content="<?php echo $meta_desc_data; ?>" />
	

	<?php wp_head(); ?>
	<meta name="google-site-verification" content="elDfEnNmWenEiX3OoDp3tNl7LPorXjELbb-27k2CyYk" />
 
	<meta name="yandex-verification" content="eeae7ce94b1c9a0a" />
	
	</head>
	<div class="top-menu-header">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-sidebar') ) : 
 
endif; ?>
</div>

<div class="tophear">
<div class="inner-container">
	
			<div class="leftlogo">
			<div class="site-branding">
				<?php
					twentyfifteen_the_custom_logo();

				if ( is_front_page() && is_home() ) :
					?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
						?>
						<?php
					endif;
					?>
				<button class="secondary-toggle"><?php _e( 'Menu and widgets', 'twentyfifteen' ); ?></button>
			</div><!-- .site-branding -->
</div>
<div class="rightsearchbar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-sidebar') ) : 
 
endif; ?>
</div>
	</div>
<div class="menu-navigation">
	<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
					// Primary navigation menu.
					wp_nav_menu(
						array(
							'menu_class'     => 'nnav-menu',
							'theme_location' => 'top-menu',
						)
					);
				?>
			</nav><!-- .main-navigation -->
</div>
</div>
<div class="mobile-search">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-sidebar') ) : 
 
endif; ?>
</div>
<body <?php body_class(); ?>>	
	<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
<?php wp_body_open(); ?>
	
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyfifteen' ); ?></a>

	
	<div id="sidebar" class="sidebar" style="position: absolute;">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php
					twentyfifteen_the_custom_logo();

				if ( is_front_page() && is_home() ) :
					?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $description; ?></p>
						<?php
					endif;
					?>
				<button class="secondary-toggle"><?php _e( 'Menu and widgets', 'twentyfifteen' ); ?></button>
			</div><!-- .site-branding -->
		</header><!-- .site-header -->

		<?php get_sidebar(); ?>
	</div><!-- .sidebar -->

	<div id="content" class="site-content">