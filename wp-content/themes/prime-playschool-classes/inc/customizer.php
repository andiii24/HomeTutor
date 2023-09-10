<?php
/**
 * Prime Playschool Classes Theme Customizer.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package prime_playschool_classes
 */

if( ! function_exists( 'prime_playschool_classes_customize_register' ) ):  
/**
 * Add postMessage support for site title and description for the Theme Customizer.F
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prime_playschool_classes_customize_register( $wp_customize ) {

    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'prime-playschool-classes' );
    }
	
    /* Option list of all post */	
    $prime_playschool_classes_options_posts = array();
    $prime_playschool_classes_options_posts_obj = get_posts('posts_per_page=-1');
    $prime_playschool_classes_options_posts[''] = esc_html__( 'Choose Post', 'prime-playschool-classes' );
    foreach ( $prime_playschool_classes_options_posts_obj as $prime_playschool_classes_posts ) {
    	$prime_playschool_classes_options_posts[$prime_playschool_classes_posts->ID] = $prime_playschool_classes_posts->post_title;
    }
    
    /* Option list of all categories */
    $prime_playschool_classes_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $prime_playschool_classes_option_categories = array();
    $prime_playschool_classes_category_lists = get_categories( $prime_playschool_classes_args );
    $prime_playschool_classes_option_categories[''] = esc_html__( 'Choose Category', 'prime-playschool-classes' );
    foreach( $prime_playschool_classes_category_lists as $prime_playschool_classes_category ){
        $prime_playschool_classes_option_categories[$prime_playschool_classes_category->term_id] = $prime_playschool_classes_category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Default Settings', 'prime-playschool-classes' ),
            'description' => esc_html__( 'Default section provided by wordpress customizer.', 'prime-playschool-classes' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel                  = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel                         = 'wp_default_panel';
    $wp_customize->get_section( 'header_image' )->panel                   = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel               = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel              = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /** Default Settings Ends */

    /** Post Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_post_settings',
        array(
            'title' => esc_html__( 'Post Settings', 'prime-playschool-classes' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );

    /** Post Heading control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_post_heading_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_post_heading_setting',
        array(
            'label'       => __( 'Show / Hide Post Heading', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Meta control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Post Meta', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Image control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_post_image_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_post_image_setting',
        array(
            'label'       => __( 'Show / Hide Post Image', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Content control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Post Content', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Settings Ends */

    /** General Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_general_settings',
        array(
            'title' => esc_html__( 'General Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );

    /** Scroll to top control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_footer_scroll_to_top', 
        array(
            'default' => 1,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_footer_scroll_to_top',
        array(
            'label'       => __( 'Show Scroll To Top', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_general_settings',
            'type'        => 'checkbox',
        )
    );

    /** Preloader control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_header_preloader', 
        array(
            'default' => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_header_preloader',
        array(
            'label'       => __( 'Show Preloader', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_general_settings',
            'type'        => 'checkbox',
        )
    );

    /** Header Section Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_header_section_settings',
        array(
            'title' => esc_html__( 'Header Section Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );

    /**  Location */
    $wp_customize->add_setting(
        'prime_playschool_classes_header_location',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_header_location',
        array(
            'label' => esc_html__( 'Add Location', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_header_section_settings',
            'type' => 'text',
        )
    );

    /** Email */
    $wp_customize->add_setting(
        'prime_playschool_classes_header_email',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_header_email',
        array(
            'label' => esc_html__( 'Add Email', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_header_section_settings',
            'type' => 'text',
        )
    );

    /** Phone */
    $wp_customize->add_setting(
        'prime_playschool_classes_header_phone',
        array( 
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_header_phone',
        array(
            'label' => esc_html__( 'Add Phone', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_header_section_settings',
            'type' => 'text',
        )
    );

    /** Header Section Settings End */

    /** Socail Section Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_social_section_settings',
        array(
            'title' => esc_html__( 'Social Media Section Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );

    /**  Social Link 1 */
    $wp_customize->add_setting(
        'prime_playschool_classes_social_link_1',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_social_link_1',
        array(
            'label' => esc_html__( 'Add Facebook Link', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 2 */
    $wp_customize->add_setting(
        'prime_playschool_classes_social_link_2',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_social_link_2',
        array(
            'label' => esc_html__( 'Add Twitter Link', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 3 */
    $wp_customize->add_setting(
        'prime_playschool_classes_social_link_3',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_social_link_3',
        array(
            'label' => esc_html__( 'Add Instagram Link', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_social_section_settings',
            'type' => 'url',
        )
    );

    /**  Social Link 4 */
    $wp_customize->add_setting(
        'prime_playschool_classes_social_link_4',
        array( 
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh'
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_social_link_4',
        array(
            'label' => esc_html__( 'Add Pintrest Link', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_social_section_settings',
            'type' => 'url',
        )
    );

    /** Socail Section Settings End */

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'prime_playschool_classes_home_page_settings',
         array(
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Home Page Settings', 'prime-playschool-classes' ),
            'description' => esc_html__( 'Customize Home Page Settings', 'prime-playschool-classes' ),
        ) 
    );

    /** Slider Section Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_slider_section_settings',
        array(
            'title' => esc_html__( 'Slider Section Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_home_page_settings',
        )
    );
    
    $categories = get_categories();
        $cat_posts = array();
            $i = 0;
            $cat_posts[]='Select';
        foreach($categories as $category){
            if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting(
        'prime_playschool_classes_blog_slide_category',
        array(
            'default'   => 'select',
            'sanitize_callback' => 'prime_playschool_classes_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'prime_playschool_classes_blog_slide_category',
        array(
            'type'    => 'select',
            'choices' => $cat_posts,
            'label' => __('Select Category to display Latest Post','prime-playschool-classes'),
            'section' => 'prime_playschool_classes_slider_section_settings',
        )
    );

    /** Classes Section Settings */
    $wp_customize->add_section(
        'prime_playschool_classes_classes_section_settings',
        array(
            'title' => esc_html__( 'Classes Section Settings', 'prime-playschool-classes' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'prime_playschool_classes_home_page_settings',
        )
    );

    // Section Title
    $wp_customize->add_setting(
        'prime_playschool_classes_section_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'prime_playschool_classes_section_title', 
        array(
            'label'       => __('Section Title', 'prime-playschool-classes'),
            'section'     => 'prime_playschool_classes_classes_section_settings',
            'settings'    => 'prime_playschool_classes_section_title',
            'type'        => 'text'
        )
    );

    // Section Text
    $wp_customize->add_setting(
        'prime_playschool_classes_section_text', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'prime_playschool_classes_section_text', 
        array(
            'label'       => __('Section Text', 'prime-playschool-classes'),
            'section'     => 'prime_playschool_classes_classes_section_settings',
            'settings'    => 'prime_playschool_classes_section_text',
            'type'        => 'text'
        )
    );

    $categories = get_categories();
        $cat_posts = array();
            $i = 0;
            $cat_posts[]='Select';
        foreach($categories as $category){
            if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting(
        'prime_playschool_classes_student_category',
        array(
            'default'   => 'select',
            'sanitize_callback' => 'prime_playschool_classes_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'prime_playschool_classes_student_category',
        array(
            'type'    => 'select',
            'choices' => $cat_posts,
            'label' => __('Select Category to display classes post','prime-playschool-classes'),
            'section' => 'prime_playschool_classes_classes_section_settings',
        )
    );
    
    /** Home Page Settings Ends */
    
    /** Footer Section */
    $wp_customize->add_section(
        'prime_playschool_classes_footer_section',
        array(
            'title' => __( 'Footer Settings', 'prime-playschool-classes' ),
            'priority' => 70,
        )
    );

    /** Footer Copyright control */
    $wp_customize->add_setting( 
        'prime_playschool_classes_footer_setting', 
        array(
            'default' => true,
            'sanitize_callback' => 'prime_playschool_classes_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'prime_playschool_classes_footer_setting',
        array(
            'label'       => __( 'Show Footer Copyright', 'prime-playschool-classes' ),
            'section'     => 'prime_playschool_classes_footer_section',
            'type'        => 'checkbox',
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'prime_playschool_classes_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'prime_playschool_classes_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'prime-playschool-classes' ),
            'section' => 'prime_playschool_classes_footer_section',
            'type' => 'text',
        )
    );  

    function prime_playschool_classes_sanitize_choices( $input, $setting ) {
        global $wp_customize; 
        $control = $wp_customize->get_control( $setting->id ); 
        if ( array_key_exists( $input, $control->choices ) ) {
            return $input;
        } else {
            return $setting->default;
        }
    }

}
add_action( 'customize_register', 'prime_playschool_classes_customize_register' );
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function prime_playschool_classes_customize_preview_js() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $prime_playschool_classes_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $prime_playschool_classes_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'prime_playschool_classes_customizer', get_template_directory_uri() . '/js' . $prime_playschool_classes_build . '/customizer' . $prime_playschool_classes_suffix . '.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'prime_playschool_classes_customize_preview_js' );