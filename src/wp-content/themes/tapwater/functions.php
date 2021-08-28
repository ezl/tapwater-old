<?php

add_action('wp_enqueue_scripts', 'tapwater_styles_and_scripts');

function tapwater_styles_and_scripts(){
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_style('map_style', get_template_directory_uri().'/map/style.css');
    wp_enqueue_style('main_style', get_template_directory_uri().'/style.css');
    
    wp_enqueue_style('leaflet', '//unpkg.com/leaflet@1.6.0/dist/leaflet.css');
    wp_enqueue_style('leaflet-gestures', '//unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css');
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', [],'1.0',true );
    wp_enqueue_script('leaflet-js', '//unpkg.com/leaflet@1.6.0/dist/leaflet.js' );
    wp_enqueue_script('leaflet-gestures-js', '//unpkg.com/leaflet-gesture-handling' );
    wp_enqueue_script('leaflet-ajax-js', '//cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js' );
    wp_enqueue_script('utils-index-js', get_stylesheet_directory_uri() . '/map/utils/index.js', [],'1.0',true );
    wp_enqueue_script('index-js', get_stylesheet_directory_uri() . '/map/index.js', [],'1.0',true );
    wp_enqueue_style('google_fonts_lato', '//fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');
    wp_enqueue_style('google_fonts_lora', '//fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap');
}

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}


//custom post types

add_action('init', 'tw_post_types');

function tw_post_types(){

register_post_type('blog-post', array(
    'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
    'public' => true,
    'rewrite' => array('slug' => 'blog'),
    'labels' => array(
      'name' => 'Blog posts',
      'add_new_item' => 'Add New Blog post',
      'edit_item' => 'Edit Blog post',
      'all_items' => 'All Blog posts',
      'singular_name' => 'Blog post'
    ),
    'show_in_rest' => true,
    'supports' => array('editor')

  ));

}


//Breadcrumbs

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
        if($country && $categories[0]->name != 'Home'){echo '<li>'.$separator.'<a href="'.site_url("/tap-water-safety-in-").$country_slug.'">'.$country.'</a></li>';}
    //state - for usa only
    if($state){
        echo '<li>'.$separator.'<a href="'.site_url("/tap-water-safety-in-").$state_slug.'">'.$state.'</a></li>';
    }
    
    //city-post
        if(get_field('city_name')){
            echo '<li> '.$separator.get_field('city_name').'</li>';
        }
        
    
        
        echo '</ul>';
    }
    

endif;

// Remove empts paragraphs from content

remove_filter('the_content', 'wpautop');

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
            'orderby' => 'title'//temporary ordering
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