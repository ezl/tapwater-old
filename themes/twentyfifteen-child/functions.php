<?php

add_action('wp_enqueue_scripts', 'parent_styles');

function parent_styles(){
    wp_enqueue_style('parent_style', get_template_directory_uri().'/style.css');
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ),'',true );
}

//add categories to pages
function categories_for_pages() {
register_taxonomy_for_object_type( 'post_tag', 'page' );
register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'categories_for_pages' );

//add pages to wp query
function add_taxonomies_to_pages() {
 register_taxonomy_for_object_type( 'post_tag', 'page' );
 register_taxonomy_for_object_type( 'category', 'page' );
 }
 
add_action( 'init', 'add_taxonomies_to_pages' );
 if ( ! is_admin() ) {
 add_action( 'pre_get_posts', 'category_and_tag_archives' );
 
 }
function category_and_tag_archives( $wp_query ) {
$my_post_array = array('post','page');
 
 if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) ){
 $wp_query->set( 'post_type', $my_post_array );
 }
 if ( $wp_query->get( 'tag' ) ){
 $wp_query->set( 'post_type', $my_post_array );
 }
}

//breadcrumbs
if(!is_admin()):
    function breadcrumbs() {
        $separator = '<span class="sep">></span>';
        $home = site_url();
        
        $categories = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id'));
        
        $continent = $categories[0]->name;
        $continent_slug = $categories[0]->slug;
        $country = $categories[1]->name;
        $country_slug = $categories[1]->slug;
        $state = $categories[2]->name;
        $state_slug = $categories[2]->slug;
        
        echo '<ul class="breadcrumbs">';
    //home
        echo '<li><a href="'.$home.'">Home</a></li>';
    //continent-page
        if($continent && $categories[0]->name != 'Home'){echo '<li>'.$separator.'<a href="'.site_url("/$continent_slug").'">'.$continent.'</a></li>';}else{
        echo '<li>'.$separator.get_the_title().'</li>';
        }

    //country-page
        if($country /*&& get_post_type() != 'page'*/ && $categories[0]->name != 'Home'){echo '<li>'.$separator.'<a href="'.site_url("/tap-water-safety-in-").$country_slug.'">'.$country.'</a></li>';}
    //state - for usa only
    if($state){
        echo '<li>'.$separator.'<a href="'.site_url("/tap-water-safety-in-").$state_slug.'">'.$state.'</a></li>';
    }
    //city-post
        if(get_field('city_name')){
            echo '<li> '.$separator.get_field('city_name').'</li>';
        }
        /*else if($country && !$state){
            echo '<li> '.$separator.$country.'</li>';
        }*/
        
        echo '</ul>';
    }
endif;

// Add Shortcode Top cities in country
function tw_topcities() {
    
if(!is_admin()):
  
    $categories = wp_get_post_terms(get_the_ID(), 'category',  array('fields' => 'all', 'orderby' => 'term_id'));
    $country_slug = $categories[1]->slug;
    $currentid = get_the_ID();
    $query = new WP_query(array(
        'post_type' => 'post',
        'post__not_in' => array($currentid),
        'category_name' => $country_slug,
        'posts_per_page' => 3,
        'orderby' => 'title'
    ));
    $data = '';
    if($query->have_posts()):
        $data .= '<ul>';
        while($query->have_posts()):
            $query->the_post();
            $data .= '<li><a href="'.get_the_permalink().'">';
            $data .= get_field('city_name');
            $data .= '</a></li>';
        endwhile;
        $data .= '</ul>';
        
    endif;
    wp_reset_postdata();

    return $data;

endif;
}
add_shortcode( 'tw_topcities', 'tw_topcities' );

// verbose page rule, category slug to point to page first
add_action( 'init', 'wpse16902_init' );
function wpse16902_init() {
    $GLOBALS['wp_rewrite']->use_verbose_page_rules = true;
}

add_filter( 'page_rewrite_rules', 'wpse16902_collect_page_rewrite_rules' );
function wpse16902_collect_page_rewrite_rules( $page_rewrite_rules )
{
    $GLOBALS['wpse16902_page_rewrite_rules'] = $page_rewrite_rules;
    return array();
}

add_filter( 'rewrite_rules_array', 'wspe16902_prepend_page_rewrite_rules' );
function wspe16902_prepend_page_rewrite_rules( $rewrite_rules )
{
    return $GLOBALS['wpse16902_page_rewrite_rules'] + $rewrite_rules;
}




