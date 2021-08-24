<?php
/**
 * education-institute Theme Customizer
 *
 * @package education-institute
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function education_institute_customize_register( $wp_customize ) {
	
	// education-institute theme choice options
    if (!function_exists('education_institute_section_choice_option')) :
        function education_institute_section_choice_option()
        {
            $education_institute_section_choice_option = array(
                'show' => esc_html__('Show', 'education-institute'),
                'hide' => esc_html__('Hide', 'education-institute')
            );
            return apply_filters('education_institute_section_choice_option', $education_institute_section_choice_option);
        }
    endif;


    if (!function_exists('education_institute_column_layout_option')) :
        function education_institute_column_layout_option()
        {
            $education_institute_column_layout_option = array(
                '6' => esc_html__('2 Column Layout', 'education-institute'),
                '4' => esc_html__('3 Column Layout', 'education-institute'),
                '3' => esc_html__('4 Column Layout', 'education-institute'),
            );
            return apply_filters('education_institute_column_layout_option', $education_institute_column_layout_option);
        }
    endif;



    /**
     * Sanitizing the select callback example
     *
    */
    if ( !function_exists('education_institute_sanitize_select') ) :
        function education_institute_sanitize_select( $input, $setting ) {

            // Ensure input is a slug.
            $input = sanitize_text_field( $input );

            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control( $setting->id )->choices;

                // If the input is a valid key, return it; otherwise, return the default.
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
        }
    endif;


    if ( !function_exists('education_institute_column_layout_sanitize_select') ) :
        function education_institute_column_layout_sanitize_select( $input, $setting ) {

            // Ensure input is a slug.
            $input = sanitize_text_field( $input );

            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control( $setting->id )->choices;

            // If the input is a valid key, return it; otherwise, return the default.
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
        }
    endif;
    
    
    function education_institute_sanitize_dropdown_pages( $page_id, $setting ) {
        // Ensure $input is an absolute integer.
        $page_id = absint( $page_id );
    
        // If $page_id is an ID of a published page, return it; otherwise, return the default.
        return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
    }


	
    /** Front Page Section Settings starts **/	

    $wp_customize->add_panel('education-institute_frontpage', 
        array(
            'title'       => esc_html__('education-institute Options', 'education-institute'),        
		    'description' => '',                                        
		     'priority'   => 3,
        )
    );
	

    /** Header Section Settings Start **/

    $wp_customize->add_section('education-institute_header_info', 
        array(
            'title'       => esc_html__('Header Section', 'education-institute'),
            'description' => '',
            'panel'       => 'education-institute_frontpage',
            'priority'    => 100
        )
    );
  
    $wp_customize->add_setting(
    'education-institute_header_section_hideshow',
    array(
        'default'           => 'hide',
        'sanitize_callback' => 'education_institute_sanitize_select',
    )
    );

    $education_institute_header_section_hide_show_option = education_institute_section_choice_option();

    $wp_customize->add_control('education-institute_header_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Header Option', 'education-institute'),
            'description' => esc_html__('Show/hide option for Header Section.', 'education-institute'),
            'section'     => 'education-institute_header_info',
            'choices'     => $education_institute_header_section_hide_show_option,
            'priority'    => 1
        )
    );
  
	
	
	  $wp_customize->add_setting('education-institute_header_phone_value', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('education-institute_header_phone_value',
         array(
            'label'     => esc_html__('Contact Us', 'education-institute'),
            'section'   => 'education-institute_header_info',
            'priority'  => 1
        )
     );

    $wp_customize->add_setting('education-institute_header_social_link_1', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('education-institute_header_social_link_1', 
        array(
            'label'   => esc_html__('Facebook URL', 'education-institute'),
            'section' => 'education-institute_header_info',
            'priority'  => 1
        )
    );

    $wp_customize->add_setting('education-institute_header_social_link_2', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('education-institute_header_social_link_2', 
        array(
            'label'   => esc_html__('Twitter URL', 'education-institute'),
            'section' => 'education-institute_header_info',
            'priority'  => 1
        )
    );

    $wp_customize->add_setting('education-institute_header_social_link_3', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('education-institute_header_social_link_3', 
        array(
            'label'   => esc_html__('Linkedin URL', 'education-institute'),
            'section' => 'education-institute_header_info',
            'priority'  => 1
        )
    );

    $wp_customize->add_setting('education-institute_header_social_link_4', 
        array(
            'default'   =>  '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control('education-institute_header_social_link_4', 
        array(
            'label'   => esc_html__('Instagram URL', 'education-institute'),
            'section' => 'education-institute_header_info',
            'priority'  => 1
        )
    );

    
  
 /** Header Section Settings end **/

 /** Header Banner Section Settings Start **/

// Image Info
    
    $wp_customize->add_section('education-institute_image_info', array(
      'title'   => esc_html__('Home Banner Section', 'education-institute'),
      'description' => '',
      'panel' => 'education-institute_frontpage',
      'priority'    => 110
    ));
    
    $wp_customize->add_setting(
    'education_institute_section_choice_option',
    array(
        'default' => 'hide',
        'sanitize_callback' => 'education_institute_sanitize_select',
    )
    );
    $education_institute_section_choice_option = education_institute_section_choice_option();
    $wp_customize->add_control(
    'education_institute_section_choice_option',
    array(
        'type' => 'radio',
        'label' => esc_html__('Show/hide option for Image Section.', 'education-institute'),
        'description' => '',
        'section' => 'education-institute_image_info',
        'choices' => $education_institute_section_choice_option,
        'priority' => 1
    )
    );
    
    $wp_customize->add_setting('education-institute_b_image', array(     
    'default'   => '',
    'type'      => 'theme_mod',
    'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'education-institute_b_image', array(
      'label'   => esc_html__('Image', 'education-institute'),
      'section' => 'education-institute_image_info',
      'settings' => 'education-institute_b_image',
      'priority'  => 2
    )));
    
    $wp_customize->add_setting('education-institute_image_heading', array(
     'default'   => '',
      'type'      => 'theme_mod',
      'sanitize_callback'   => 'sanitize_text_field'
    ));

    $wp_customize->add_control('education-institute_image_heading', array(
      'label'   => esc_html__('Heading', 'education-institute'),
      'section' => 'education-institute_image_info',
      'priority'  => 4
    )); 
    
    $wp_customize->add_setting('education-institute_image_subheading', array(
     'default'   => '',
      'type'      => 'theme_mod',
      'sanitize_callback'   => 'sanitize_text_field'
    ));

    $wp_customize->add_control('education-institute_image_subheading', array(
      'label'   => esc_html__('Sub Heading', 'education-institute'),
      'section' => 'education-institute_image_info',
      'priority'  => 4
    ));
    
    $wp_customize->add_setting('education-institute_image_more', array(
      'default'   =>'',
      'type'      => 'theme_mod',
      'sanitize_callback'   => 'sanitize_text_field'
    ));

    $wp_customize->add_control('education-institute_image_more', array(
      'label'   => esc_html__('Button Text', 'education-institute'),
      'section' => 'education-institute_image_info',
      'priority'  => 7
    ));
    
    $wp_customize->add_setting('education-institute_image_more_url', array(
     'default'   =>  '',
      'type'      => 'theme_mod',
    'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('education-institute_image_more_url', array(
      'label'   => esc_html__('Button URL', 'education-institute'),
      'section' => 'education-institute_image_info',
      'priority'  => 8
    ));
    


 /** Header Banner Section settings End **/

 /** Header Button Section Settings end **/

 $wp_customize->add_section('education-institute_quote_info',
        array(
            'title'       => esc_html__('Header Button Option', 'education-institute'),
            'description' => '',
            'panel'       => 'education-institute_frontpage',
            'priority'    =>105
        )
    );

    $wp_customize->add_setting('education-institute_quote_section_hideshow',
        array(
            'default'           => 'hide',
            'sanitize_callback' => 'education_institute_sanitize_select',
        )
    );

    $education_institute_quote_section_hide_show_option = education_institute_section_choice_option();

    $wp_customize->add_control('education-institute_quote_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Button Option', 'education-institute'),
            'description' => esc_html__('Show/hide option for Quote Section.', 'education-institute'),
            'section'     => 'education-institute_quote_info',
            'choices'     => $education_institute_quote_section_hide_show_option,
            'priority'    => 1
        ) 
    );

    $wp_customize->add_setting('education-institute_ctah_btn1_text',
         array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('education-institute_ctah_btn1_text',
        array(
            'label'    => esc_html__('Button Text', 'education-institute'),
            'section'  => 'education-institute_quote_info',
            'priority' => 2
        )
    );  


    
    $wp_customize->add_setting('education-institute_ctah_btn1_url', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );


    $wp_customize->add_control('education-institute_ctah_btn1_url', 
        array(
            'label'    => esc_html__('Button URL', 'education-institute'),
            'section'  => 'education-institute_quote_info',
            'priority' => 3
        )
    );
    

 
    /** Services Section Settings Start **/

    $wp_customize->add_section('education-institute_services',              
        array(
            'title'       => esc_html__('Home Service Section', 'education-institute'),          
            'description' => '',             
            'panel'       => 'education-institute_frontpage',      
            'priority'    => 140,
        )
    );
    
    $wp_customize->add_setting('education-institute_services_section_hideshow',
        array(
            'default'           => 'hide',
            'sanitize_callback' => 'education_institute_sanitize_select',
        )
    );

    $education_institute_services_section_hide_show_option = education_institute_section_choice_option();

    $wp_customize->add_control(
        'education-institute_services_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Services Option', 'education-institute'),
            'description' => esc_html__('Show/hide option Section.', 'education-institute'),
            'section'     => 'education-institute_services',
            'choices'     => $education_institute_services_section_hide_show_option,
            'priority'    => 1
        )
    );


    // Services title
    $wp_customize->add_setting('education-institute_services_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


    $wp_customize->add_control('education-institute_services_title',
        array(
           'label'    => esc_html__('service Title', 'education-institute'),
           'section'  => 'education-institute_services',
           'priority' => 1
        )
    );

  
    $wp_customize->add_setting('education-institute_services_title',
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


 $wp_customize->add_setting('education-institute_services_subtitle',
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


    $wp_customize->add_control('education-institute_services_subtitle', 
        array(
           'label'    => esc_html__('service description', 'education-institute'),
           'section'  => 'education-institute_services', 
           'priority' => 1
        )
    );

// column layout
    $wp_customize->add_setting('education_institute_column_layout',
        array(
            'default'           => '4',
            'sanitize_callback' => 'education_institute_column_layout_sanitize_select',
        )
    );
    $education_institute_column_layout_option = education_institute_column_layout_option();

    $wp_customize->add_control('education_institute_column_layout',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Column Layout option ', 'education-institute'),
            'description' => '',
            'section'     => 'education-institute_services',
            'choices'     => $education_institute_column_layout_option,
            'priority'    => 2
            )
    );


    // Services 
   
    $education_institute_service_no = 6;
        for( $i = 1; $i <= $education_institute_service_no; $i++ ) {
            $education_institute_servicepage = 'education_institute_service_page_' . $i;
        
        
    $wp_customize->add_setting( $education_institute_servicepage,
        array(
            'default'           => 1,
            'sanitize_callback' => 'education_institute_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( $education_institute_servicepage,
        array(
            'label'        => esc_html__( 'Service Page ', 'education-institute' ) .$i,
            'section'      => 'education-institute_services',
            'type'         => 'dropdown-pages',
            'priority'     => 100,
        )
    );
    }
    
    /** Service Section Settings End **/
    
    /** Blog Section Settings Start **/

    $wp_customize->add_section('education-institute_blog_info', 
        array(
            'title'       => esc_html__('Home Blog Section', 'education-institute'),
            'description' => '',
            'panel'       => 'education-institute_frontpage',
            'priority'    => 150
        )
     );
    
    $wp_customize->add_setting('education-institute_blog_section_hideshow',
        array(
            'default'           => 'show',
            'sanitize_callback' => 'education_institute_sanitize_select',
        )
    );

    $education_institute_blog_section_hide_show_option = education_institute_section_choice_option();

    $wp_customize->add_control('education-institute_blog_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Blog Option', 'education-institute'),
            'description' => esc_html__('Show/hide option for Blog Section.', 'education-institute'),
            'section'     => 'education-institute_blog_info',
            'choices'     => $education_institute_blog_section_hide_show_option,
            'priority'    => 1
        )
    );
    
    $wp_customize->add_setting('education-institute_blog_title', 
         array(
            'default'            => '',
            'type'               => 'theme_mod',
            'sanitize_callback'  => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('education-institute_blog_title', 
        array(
            'label'    => esc_html__('Blog Title', 'education-institute'),
            'section'  => 'education-institute_blog_info',
            'priority' => 1
        )
    );
    
    $wp_customize->add_setting('education-institute_blog_subtitle', 
        array(
            'default'             => '',
            'type'                => 'theme_mod',
            'sanitize_callback'   => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('education-institute_blog_subtitle', 
        array(
            'label'    => esc_html__('Blog Subheading', 'education-institute'),
            'section'  => 'education-institute_blog_info', 
            'priority' => 4
        )
    );
    /** Blog Section Settings End **/

    /** Callout Section Settings Start **/
    $wp_customize->add_section(
        'education-institute_footer_contact', 
        array(
            'title'   => esc_html__('Home Callout Section', 'education-institute'),
            'description' => '',
            'panel' => 'education-institute_frontpage',
            'priority'    => 170
        )
    );

    // Setting - Callout Hideshow
    
    $wp_customize->add_setting(
        'education-institute_contact_section_hideshow',
        array(
            'default' => 'hide',
            'sanitize_callback' => 'education_institute_sanitize_select',
        )
    );

    $education_institute_section_choice_option = education_institute_section_choice_option();
    $wp_customize->add_control(
        'education-institute_contact_section_hideshow',
        array(
            'type' => 'radio',
            'label' => esc_html__('Callout Option', 'education-institute'),
            'description' => esc_html__('Show/hide option for Footer Callout Section.', 'education-institute'),
            'section' => 'education-institute_footer_contact',
            'choices' => $education_institute_section_choice_option,
            'priority' => 5
        )
    );

    // Setting - Callout details

    $wp_customize->add_setting(
        'education-institute_callout_heading', 
        array(
            'default'   => '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'education-institute_callout_heading', 
        array(
            'label'   => esc_html__('Callout Title', 'education-institute'),
            'section' => 'education-institute_footer_contact',
            'priority'  => 8
        )
    );


    $wp_customize->add_setting(
        'education-institute_callout_btn_url', 
        array(
            'default'   =>'',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control(
        'education-institute_callout_btn_url', 
        array(
            'label'   => esc_html__('Button URL', 'education-institute'),
            'section' => 'education-institute_footer_contact',
            'priority'  => 11
        )
    );

    $wp_customize->add_setting(
        'education-institute_callout_btn_text', 
        array(
            'default'   => '',
            'type'      => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'education-institute_callout_btn_text', 
        array(
            'label'   => esc_html__('Button Text', 'education-institute'),
            'section' => 'education-institute_footer_contact',
            'priority'  => 10
        )
    );

    /** Callout Section Settings End **/


    /** Footer Section Settings Start **/

	$wp_customize->add_section('education-institute_footer_info',
        array(
            'title'       => esc_html__('Footer Section', 'education-institute'),
            'description' => '',
            'panel'       => 'education-institute_frontpage',
            'priority'    => 180
        )
    );

    $wp_customize->add_setting('education-institute_footer_section_hideshow',
        array(
            'default'           => 'show',
            'sanitize_callback' => 'education_institute_sanitize_select',
        )
    );

    $education_institute_footer_section_hide_show_option = education_institute_section_choice_option();

    $wp_customize->add_control('education-institute_footer_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Footer Option', 'education-institute'),
            'description' => esc_html__('Show/hide option for Footer Section.', 'education-institute'),
            'section'     => 'education-institute_footer_info',
            'choices'     => $education_institute_footer_section_hide_show_option,
            'priority'    => 1
        ) 
    );



    $wp_customize->add_setting('education-institute_footer_text',
         array(
            'default'             => '',
            'type'                => 'theme_mod',
            'sanitize_callback'   => 'wp_kses_post'
        )
    );

    $wp_customize->add_control('education-institute_footer_text',
         array(
            'label'    => esc_html__('Copyright', 'education-institute'),
            'section'  => 'education-institute_footer_info',
            'type'     => 'textarea',
            'priority' => 2
    ));

    /** Footer Section Settings End **/

}
add_action( 'customize_register', 'education_institute_customize_register' );