<?php
/**
 * Craft Blog Theme Customizer
 *
 * @package Craft_Blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function craft_blog_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'craft_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'craft_blog_customize_partial_blogdescription',
		) );
	}


/**
 * List All Category
*/
$categories = get_categories( );
$craft_blog_cat = array();
foreach( $categories as $category ) {
    $craft_blog_cat[$category->term_id] = $category->name;
}


/**
 * Options Array List
*/

$weblayout = array(
    'fullwidth' => esc_html__( 'FullWidth Layout', 'craft-blog' ),
    'boxed'     => esc_html__( 'Boxed Layout', 'craft-blog' ),
);

$post_layout = array(
    'list-rsidebar'   => esc_html__( 'List Style - Right Sidebar', 'craft-blog' ),
    'grid-rsidebar'   => esc_html__( 'Grid Style ( 1 Column ) - Right Sidebar', 'craft-blog' ),
    'gridcol2-rsidebar'   => esc_html__( 'Grid Style ( 2 Column ) - Right Sidebar', 'craft-blog' ),
    'masonry2-rsidebar'   => esc_html__( 'Masonry Style ( 2 Column ) - Right Sidebar', 'craft-blog' ),
);


$post_description = array(
    'none'     => esc_html__( 'None', 'craft-blog' ),
    'excerpt'  => esc_html__( 'Post Excerpt', 'craft-blog' ),
    'content'  => esc_html__( 'Post Content', 'craft-blog' )
);


$main_nav_align = array(
    'left'   => esc_html__( 'Left', 'craft-blog' ),
    'center' => esc_html__( 'Center', 'craft-blog' ),
    'right'  => esc_html__( 'Right', 'craft-blog' )
);


	$wp_customize->get_section( 'title_tagline' )->panel = 'craft_blog_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '5';

    $wp_customize->get_section('colors' )->title = esc_html__('Colors Settings', 'craft-blog');
    $wp_customize->get_section( 'colors' )->priority = '2';

    // Pro Version
    $wp_customize->add_setting( 'pro_version_color_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_color_options', array(
                'section'     => 'colors',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Color Options', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );

    $wp_customize->get_section( 'background_image' )->panel = 'craft_blog_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '15';

    $wp_customize->get_section( 'static_front_page' )->panel = 'craft_blog_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '20';

    $wp_customize->get_section( 'header_image' )->priority = '8';


    /**
     * About Pro Version
     *
     * @since 1.0.0
    */
    /*$wp_customize->add_section( 'craft_blog_pro' , array(
        'title'      => esc_html__( 'About Craft Blog Pro', 'craft-blog' ),
        'priority'   => 1,
    ) );

    // Pro Version
    $wp_customize->add_setting( 'craft_blog_pro_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Craft_Blopg_Customize_Pro_Version_Links ( $wp_customize,
            'craft_blog_pro_options', array(
                'section'   => 'craft_blog_pro',
                'type'      => 'pro_links',
                'priority'  => 1
            )
        )
    );*/

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
    */
    $wp_customize->add_panel(
	    'craft_blog_general_settings_panel',
	    array(
	        'priority'       => 5,
	        'theme_supports' => '',
	        'title'          => esc_html__( 'General Settings', 'craft-blog' ),
	    )
    );


    /**
     * Advance General Settings Panel
     *
     * @since 1.0.0
    */
    $wp_customize->add_section(
        'craft_blog_adcance_general_settings',
        array(
            'priority'       => 6,
            'title'          => esc_html__( 'Advance Section Width Settings', 'craft-blog' ),
        )
    );

        $wp_customize->add_setting(
            'craft_blog_website_layout_options',

            array(
                'default'           => 'fullwidth',
                'sanitize_callback' => 'craft_blog_sanitize_select',
            )       
        );

        $wp_customize->add_control(
            'craft_blog_website_layout_options',

            array(
                'type' => 'select',
                'label' => esc_html__( 'WebSite Page Layout', 'craft-blog' ),
                'section' => 'craft_blog_adcance_general_settings',
                'choices' => $weblayout
            ) 
        );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_width_settings', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_width_settings', array(
                'section'     => 'craft_blog_adcance_general_settings',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Width Settings', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );


    /**
     * Post Display Layout Section
     *
     * @since 1.0.0
    */
    $wp_customize->add_section(
        'craft_blog_display_layout',

        array(
            'title'     => esc_html__( 'Post Display Layout', 'craft-blog' ),
            'priority'  => 7,
        )
    );

        $wp_customize->add_setting( 
            'craft_blog_blog_display_layout_options', 

            array(
                'default'           => 'grid-rsidebar',
                'sanitize_callback' => 'craft_blog_sanitize_select'
            ) 
        );
        
        $wp_customize->add_control( 
            'craft_blog_blog_display_layout_options', 

            array(
                'type' => 'select',
                'label' => esc_html__( 'Home Blog Post Display Layout', 'craft-blog' ),
                'section' => 'craft_blog_display_layout',
                'choices' => $post_layout
            ) 
        );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_feed_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_post_feed_options', array(
                'section'     => 'craft_blog_display_layout',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Post Feed Layout', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );


    /**
     * Post Display Layout Section
     *
     * @since 1.0.0
    */
    $wp_customize->add_section(
        'craft_blog_post_meta_general_settings',

        array(
            'title'     => esc_html__( 'Post Themes Optons Settings', 'craft-blog' ),
            'priority'  => 7,
        )
    );

        /**
         * Continue Reading Button Text
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'craft_blog_post_continue_reading_text',
            array(
                'default'    => esc_html__('Continue Reading','craft-blog'),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'craft_blog_post_continue_reading_text',

            array(
                'type'      => 'text',
                'label'     => esc_html__( 'Enter Continue Reading Button Text', 'craft-blog' ),
                'section'   => 'craft_blog_post_meta_general_settings',
            )
        );

        
        $wp_customize->add_setting( 
            'craft_blog_post_description_options', 

            array(
                'default'           => 'excerpt',
                'sanitize_callback' => 'craft_blog_sanitize_select'
            ) 
        );
        
        $wp_customize->add_control( 
            'craft_blog_post_description_options', 

            array(
                'type' => 'select',
                'label' => esc_html__( 'Post Description', 'craft-blog' ),
                'section' => 'craft_blog_post_meta_general_settings',
                'settings' => 'craft_blog_post_description_options',
                'choices' => $post_description
            ) 
        );

        /**
         * Number field for Excerpt Length section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'craft_blog_post_excerpt_length',
            array(
                'default'    => 30,
                'sanitize_callback' => 'absint'
            )
        );

        $wp_customize->add_control(
            'craft_blog_post_excerpt_length',

            array(
                'type'      => 'number',
                'label'     => esc_html__( 'Enter Posts Excerpt Length', 'craft-blog' ),
                'section'   => 'craft_blog_post_meta_general_settings',
            )
        );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_themes_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_post_themes_options', array(
                'section'     => 'craft_blog_post_meta_general_settings',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Post Options', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );

    /**
     * Add Header Section
     *
     * @since 1.0.0
    */
    $wp_customize->add_section(
        'craft_blog_top_header_section',

        array(
            'title'     => esc_html__( 'Main Header Setting', 'craft-blog' ),
            'priority'       => 7,
        )
    );

    /**
     * Enable/Disable option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
    	'craft_blog_top_header_section_options', 

    	array(
			'sanitize_callback' => 'craft_blog_sanitize_on_off',
			'default' => 'on'
		) 
	);

	$wp_customize->add_control( new Craft_Blog_Switch_Control( 
		$wp_customize, 
			'craft_blog_top_header_section_options', 

			array(
				'settings'		=> 'craft_blog_top_header_section_options',
				'section'		=> 'craft_blog_top_header_section',
				'label'			=> esc_html__( 'Top Header Section', 'craft-blog' ),
				'description'   => esc_html__( 'Enable/Disable option for top header.', 'craft-blog' ),
				'on_off_label' 	=> array(
					'on'  => esc_html__( 'Enable', 'craft-blog' ),
					'off' => esc_html__( 'Disable', 'craft-blog' )
				)	
			) 
		) 
	);



    /**
     * Main Navigation section
     *
     * @since 1.0.0
    */
    $wp_customize->add_section(
        'craft_blog_main_nav_section',

        array(
            'title'     => esc_html__( 'Main Navigation Settings', 'craft-blog' ),
            'priority'  => 9,
        )
    );


        $wp_customize->add_setting( 
            'craft_blog_main_nav_align', 

            array(
                'default'           => 'center',
                'sanitize_callback' => 'craft_blog_sanitize_select'
            ) 
        );
        
        $wp_customize->add_control( 
            'craft_blog_main_nav_align', 

            array(
                'type' => 'select',
                'label' => esc_html__( 'Main Menu Align', 'craft-blog' ),
                'section' => 'craft_blog_main_nav_section',
                'settings' => 'craft_blog_main_nav_align',
                'choices' => $main_nav_align
            ) 
        );


        $wp_customize->add_setting( 
            'craft_blog_nav_sticky', 

            array(
                'sanitize_callback' => 'craft_blog_sanitize_on_off',
                'default' => 'on'
            ) 
        );

        $wp_customize->add_control( new Craft_Blog_Switch_Control( 
            $wp_customize, 
                'craft_blog_nav_sticky', 

                array(
                    'settings'      => 'craft_blog_nav_sticky',
                    'section'       => 'craft_blog_main_nav_section',
                    'label'         => esc_html__( 'Sticky Main Menu', 'craft-blog' ),
                    'on_off_label'  => array(
                        'on'  => esc_html__( 'Enable', 'craft-blog' ),
                        'off' => esc_html__( 'Disable', 'craft-blog' )
                    ),
                    'description'   => esc_html__( 'Enable/Disable option for main menu.', 'craft-blog' ),
                ) 
            ) 
        );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_nav_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_post_nav_options', array(
                'section'     => 'craft_blog_main_nav_section',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Nav Options', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );


    /**
     * Archive/Category Settings
     *
     * @since 1.0.0
    */

    $wp_customize->add_section(
        'craft_blog_main_slider_section',

        array(
            'title'     => esc_html__( 'Main Slider Settings', 'craft-blog' ),
            'priority'       => 10,
        )
    );

        /**
         * Enable/Disable option for Main Slider
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 
            'craft_blog_slider_section_options', 

            array(
                'sanitize_callback' => 'craft_blog_sanitize_on_off',
                'default' => 'on'
            ) 
        );

        $wp_customize->add_control( new Craft_Blog_Switch_Control( 
            $wp_customize, 
                'craft_blog_slider_section_options', 

                array(
                    'settings'      => 'craft_blog_slider_section_options',
                    'section'       => 'craft_blog_main_slider_section',
                    'label'         => esc_html__( 'Main Slider Section', 'craft-blog' ),
                    'description'   => esc_html__( 'Enable/Disable option for main slider.', 'craft-blog' ),
                    'on_off_label'  => array(
                        'on'  => esc_html__( 'Enable', 'craft-blog' ),
                        'off' => esc_html__( 'Disable', 'craft-blog' )
                    )   
                ) 
            ) 
        );

        $wp_customize->add_setting( 
            'craft_blog_slider_term_id', 

            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field'
            ) 
        );
        
        $wp_customize->add_control( new Craft_Blopg_Customize_Control_Checkbox_Multiple( 
            $wp_customize, 
            'craft_blog_slider_term_id', 

            array(
                'label' => esc_html__( 'Select Main Slider Cateogry', 'craft-blog' ),
                'section' => 'craft_blog_main_slider_section',
                'settings' => 'craft_blog_slider_term_id',
                'choices' => $craft_blog_cat
            ) ) 
        );


        /**
         * Number field for main slider post section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'craft_blog_number_post_slider_options',
            array(
                'default'    => 5,
                'sanitize_callback' => 'absint'
            )
        );

        $wp_customize->add_control(
            'craft_blog_number_post_slider_options',

            array(
                'type'      => 'number',
                'label'     => esc_html__( 'Enter Display Number of Slider Posts', 'craft-blog' ),
                'section'   => 'craft_blog_main_slider_section',
            )
        );


    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_slider_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_post_slider_options', array(
                'section'     => 'craft_blog_main_slider_section',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Slider Options', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );


    /**
     * Features Promo Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'craft_blog_features_promo_section',

        array(
            'title'     => esc_html__( 'Features Promo Settings', 'craft-blog' ),
            'priority'  => 10,
        )
    );


    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_promo_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_post_promo_options', array(
                'section'     => 'craft_blog_features_promo_section',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Promo Options', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );


	/**
	 * Register the radio image control class as a JS control type.
	*/
    $wp_customize->register_control_type( 'Craft_Blog_Customize_Control_Radio_Image' );

	/**
     * Add Design Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'craft_blog_design_settings_panel',

	    array(
	        'priority'       => 11,
	        'title'          => esc_html__( 'Design Layout Settings', 'craft-blog' ),
	    )
    );

	/**
     * Archive/Category Settings
     *
     * @since 1.0.0
    */

    $wp_customize->add_section(
        'craft_blog_archive_settings_section',

        array(
            'title'     => esc_html__( 'Archive/Category Settings', 'craft-blog' ),
            'panel'     => 'craft_blog_design_settings_panel',
        )
    );      

    /**
     * Image Radio field for archive/category sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'craft_blog_archive_sidebar',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new Craft_Blog_Customize_Control_Radio_Image(
        $wp_customize,
        'craft_blog_archive_sidebar',

            array(
                'label'    => esc_html__( 'Archive/Category Sidebars', 'craft-blog' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'craft-blog' ),
                'section'  => 'craft_blog_archive_settings_section',
                'choices'  => array(
                        'leftsidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'craft-blog' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'rightsidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'craft-blog' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        )
                )
            )
        )
    );


    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'craft_blog_page_settings_section',

        array(
            'title'     => esc_html__( 'Page Layout Settings', 'craft-blog' ),
            'panel'     => 'craft_blog_design_settings_panel',
        )
    );      

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'craft_blog_default_page_sidebar',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new Craft_Blog_Customize_Control_Radio_Image(
        $wp_customize,
        'craft_blog_default_page_sidebar',

            array(
                'label'    => esc_html__( 'Page Sidebars Settings', 'craft-blog' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'craft-blog' ),
                'section'  => 'craft_blog_page_settings_section',
                'choices'  => array(
                        'leftsidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'craft-blog' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'rightsidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'craft-blog' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        )
                )
            )
        )
    );

    /**
     * Post Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'craft_blog_post_settings_section',

        array(
            'title'     => esc_html__( 'Single Post Layout Settings', 'craft-blog' ),
            'panel'     => 'craft_blog_design_settings_panel',
        )
    );      

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'craft_blog_default_post_sidebar',

        array(
            'default'           => 'rightsidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );

    $wp_customize->add_control( new Craft_Blog_Customize_Control_Radio_Image(
        $wp_customize,
        'craft_blog_default_post_sidebar',

            array(
                'label'    => esc_html__( 'Post Sidebars Settings', 'craft-blog' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'craft-blog' ),
                'section'  => 'craft_blog_post_settings_section',
                'choices'  => array(
                        'leftsidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'craft-blog' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'rightsidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'craft-blog' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        )
                )
            )
        )
    );

    /**
     * Enable/Disable Option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'craft_blog_author_posts_option', 

        array(
            'sanitize_callback' => 'craft_blog_sanitize_on_off',
            'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Craft_Blog_Switch_Control( 
        $wp_customize, 
            'craft_blog_author_posts_option', 

            array(
                'settings'      => 'craft_blog_author_posts_option',
                'section'       => 'craft_blog_post_settings_section',
                'label'         => esc_html__( 'Post Author Options', 'craft-blog' ),
                'description'   => esc_html__( 'Enable/Disable option for Author Post.', 'craft-blog' ),
                'on_off_label'  => array(
                    'on'  => esc_html__( 'Enable', 'craft-blog' ),
                    'off' => esc_html__( 'Disable', 'craft-blog' )
                )   
            ) 
        ) 
    );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_single_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_post_single_options', array(
                'section'     => 'craft_blog_post_settings_section',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Single Post Options', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );


    /**
	 * Social Media Icons Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'craft_blog_social_icons_section',

        array(
            'title'		=> esc_html__( 'Social Media Links Settings', 'craft-blog' ),
            'priority'  => 15,
        )
    );

    /**
     * Repeater field for social media links icons
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'craft_blog_social_media_icons',

        array(
            'sanitize_callback' => 'craft_blog_sanitize_repeater',
            'default' => json_encode(array(
                array(
                    'social_icon_class' => 'fa fa-facebook',
                    'social_icon_url' => '',
                )
            ))
        )
    );

    $wp_customize->add_control( new Craft_Blog_Repeater_Controler(
        $wp_customize, 
            'craft_blog_social_media_icons', 

            array(
                'label'   => esc_html__( 'Sociala Media Link Settings', 'craft-blog' ),
                'section' => 'craft_blog_social_icons_section',
                'settings' => 'craft_blog_social_media_icons',
                'craft_blog_box_label'       => esc_html__( 'Social Media Icon','craft-blog' ),
                'craft_blog_box_add_control' => esc_html__( 'Add Icon','craft-blog' )
            ),

            array(
                'social_icon_class' => array(
                    'type'        => 'social_icon',
                    'label'       => esc_html__( 'Social Media Logo', 'craft-blog' ),
                    'description' => esc_html__( 'Choose social media icon.', 'craft-blog' )
                ),

                'social_icon_url' => array(
                    'type'        => 'url',
                    'label'       => esc_html__( 'Social Meida URL', 'craft-blog' ),
                    'description' => esc_html__( 'Enter social media url.', 'craft-blog' )
                )
            )
        ) 
    );


    /**
	 * Footer Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
		'craft_blog_footer_section',

		array(
			'title' => esc_html__( 'Main Footer Settings', 'craft-blog' ),
			'priority' => 20,
		)
	);


    $wp_customize->add_setting( 
        'craft_blog_footer_logo', 

        array(
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( 
        $wp_customize, 
        'craft_blog_footer_logo',

            array(
                'section'       => 'craft_blog_footer_section',
                'label'         => esc_html__('Upload Footer Logo', 'craft-blog'),
                'type'          => 'image',
            )
        )
    );


	$wp_customize->add_setting(
		'craft_blog_footer_section_options', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'craft_blog_footer_section_options',

		array(
			'type' => 'textarea',
			'label' => esc_html__('Footer Content (Copyright Text)', 'craft-blog'),
			'section' => 'craft_blog_footer_section',
			'settings' => 'craft_blog_footer_section_options'
		) 
	);


    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_options', array(
        'sanitize_callback' => 'craft_blog_sanitize_custom_control'
    ) );

    $wp_customize->add_control( new Craft_Blog_Customize_Pro_Version ( $wp_customize,
            'pro_version_footer_options', array(
                'section'     => 'craft_blog_footer_section',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Footer Options', 'craft-blog' ),
                'description' => esc_html( 'https://sparklewpthemes.com/wordpress-themes/craftblogpro/' ),
                'priority'    => 100
            )
        )
    );


    /**
	 * On/Off Sanitization Function
	 *
	 * @since 1.0.0
	 */
    function craft_blog_sanitize_on_off($input) {

       $valid_keys = array(
          	'on'  => esc_html__( 'Enable', 'craft-blog' ),
			'off' => esc_html__( 'Disable', 'craft-blog' )
       );
       if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
       } else {
          return '';
       }

    }


    /**
     * Select Box Sanitization Function
     *
     * @since 1.0.0
    */
    function craft_blog_sanitize_select( $input, $setting ) {
        
        // get all select options
        $options = $setting->manager->get_control( $setting->id )->choices;
        
        // return default if not valid
        return ( array_key_exists( $input, $options ) ? $input : $setting->default );
    }


    /**
     * Category Colors Sanitization
     *
     * @since 1.0.0
     */
    function craft_blog_color_option_hex_sanitize( $color ) {

      if ( $unhashed = sanitize_hex_color_no_hash( $color ) )

         return '#' . $unhashed;
     
      return $color;
    }

    function craft_blog_color_escaping_option_sanitize( $input ) {

      $input = esc_attr($input);

      return $input;
    }

    /**
	 * Sanitize repeater value
	 *
	 * @since 1.0.0
	 */
	function craft_blog_sanitize_repeater( $input ){

	    $input_decoded = json_decode( $input, true );
	        
	    if( !empty( $input_decoded ) ) {
	        foreach ( $input_decoded as $boxes => $box ){
	            foreach ( $box as $key => $value ){
	                $input_decoded[$boxes][$key] = wp_kses_post( $value );
	            }
	        }
	        return json_encode( $input_decoded );
	    }
	    
	    return $input;
	}


}
add_action( 'customize_register', 'craft_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function craft_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function craft_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Move Pro Tags Custom Controls
 *
 * @return void
 */
function craft_blog_sanitize_custom_control( $input ) {
    return $input;
}



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 *
 */
function craft_blog_customize_backend_scripts() {

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
    
    wp_enqueue_style( 'craft-blog-customizer', get_template_directory_uri() . '/assets/css/craftblog-customizer.css' );

    wp_enqueue_script( 'craft-blog-customizer', get_template_directory_uri() . '/assets/js/craftblog-customizer.js', array( 'jquery', 'customize-controls' ), '20180910', true );
	
}
add_action( 'customize_controls_enqueue_scripts', 'craft_blog_customize_backend_scripts' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function craft_blog_customize_preview_js() {
	wp_enqueue_script( 'craft-blog-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'craft_blog_customize_preview_js' );
