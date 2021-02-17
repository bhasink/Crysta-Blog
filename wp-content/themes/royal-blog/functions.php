<?php
/**
 * Describe child theme functions
 *
 * @package Craft Blog
 * @subpackage Royal Blog
 * 
 */

if ( ! function_exists( 'royalblog_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function royalblog_setup() {
        
        $royalblog_theme_info = wp_get_theme();
        $GLOBALS['royalblog_version'] = $royalblog_theme_info->get( 'Version' );

        add_image_size('royalblog-full-slider', 1350, 550, true);   // Full Slider

    }
endif;
add_action( 'after_setup_theme', 'royalblog_setup' );


/**
 * Managed the theme default color
 */
function royalblog_customize_register( $wp_customize ) {

		global $wp_customize;

        $wp_customize->remove_section('header_image');

        $wp_customize->remove_setting('craft_blog_footer_logo');

        /**
          * Theme Primary Color
        */
        $wp_customize->add_setting('royalblog_primary_theme_color_options', array(
            'default' => '#b565a7',
            'sanitize_callback' => 'sanitize_hex_color',        
        ));

        $wp_customize->add_control('royalblog_primary_theme_color_options', array(
            'type'     => 'color',
            'label'    => esc_html__('Primary Colors', 'royal-blog'),
            'section'  => 'colors'
        ));


        $wp_customize->add_setting( 'craft_blog_blog_display_layout_options', 
            array(
                'default'           => 'list-rsidebar',
                'sanitize_callback' => 'craft_blog_sanitize_select'
            ) 
        );


        /**
         * Features Promo Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'royalblog_features_promo_section',

            array(
                'title'     => esc_html__( 'Features Promo Settings', 'royal-blog' ),
                'priority'  => 10,
            )
        );


        $wp_customize->add_setting( 
            'royalblog_features_promo_img_one', 

            array(
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        
        $wp_customize->add_control( new WP_Customize_Image_Control( 
            $wp_customize, 
            'royalblog_features_promo_img_one',

                array(
                    'section'       => 'craft_blog_features_promo_section',
                    'label'         => esc_html__('Promo Features Image One', 'royal-blog'),
                    'type'          => 'image',
                )
            )
        );

        $wp_customize->add_setting(
            'royalblog_features_promo_title_one', 

            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'royalblog_features_promo_title_one', 

            array(
                 'label'  => esc_html__('Promo Features Title', 'royal-blog'),
                'section' => 'craft_blog_features_promo_section'
            )
        );

        $wp_customize->add_setting(
            'royalblog_features_promo_link_one', 

            array(
                'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_control(
            'royalblog_features_promo_link_one', 

            array(
                 'label'  => esc_html__('Promo Features URL', 'royal-blog'),
                'section' => 'craft_blog_features_promo_section'
            )
        );


        $wp_customize->add_setting( 
            'royalblog_features_promo_img_two', 

            array(
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        
        $wp_customize->add_control( new WP_Customize_Image_Control( 
            $wp_customize, 
            'royalblog_features_promo_img_two',

                array(
                    'section'       => 'craft_blog_features_promo_section',
                    'label'         => esc_html__('Promo Features Image Two', 'royal-blog'),
                    'type'          => 'image',
                )
            )
        );

        $wp_customize->add_setting(
            'royalblog_features_promo_title_two', 

            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'royalblog_features_promo_title_two', 

            array(
                 'label'  => esc_html__('Promo Features Title', 'royal-blog'),
                'section' => 'craft_blog_features_promo_section'
            )
        );

        $wp_customize->add_setting(
            'royalblog_features_promo_link_two', 

            array(
                'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_control(
            'royalblog_features_promo_link_two', 

            array(
                 'label'  => esc_html__('Promo Features URL', 'royal-blog'),
                'section' => 'craft_blog_features_promo_section'
            )
        );


        $wp_customize->add_setting( 
            'royalblog_features_promo_img_three', 

            array(
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        
        $wp_customize->add_control( new WP_Customize_Image_Control( 
            $wp_customize, 
            'royalblog_features_promo_img_three',

                array(
                    'section'       => 'craft_blog_features_promo_section',
                    'label'         => esc_html__('Promo Features Image Three', 'royal-blog'),
                    'type'          => 'image',
                )
            )
        );

        $wp_customize->add_setting(
            'royalblog_features_promo_title_three', 

            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'royalblog_features_promo_title_three', 

            array(
                 'label'  => esc_html__('Promo Features Title', 'royal-blog'),
                'section' => 'craft_blog_features_promo_section'
            )
        );

        $wp_customize->add_setting(
            'royalblog_features_promo_link_three', 

            array(
                'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_control(
            'royalblog_features_promo_link_three', 

            array(
                 'label'  => esc_html__('Promo Features URL', 'royal-blog'),
                'section' => 'craft_blog_features_promo_section'
            )
        );        

	}

add_action( 'customize_register', 'royalblog_customize_register', 20 );

function royalblog_register_widgets() {

    register_sidebar( array(
        'name'          => esc_html__( 'Popup Sidebar Widget Area', 'royal-blog' ),
        'id'            => 'sidebar-popup',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'royal-blog' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'royalblog_register_widgets', 99 );


/**
 * Enqueue child theme styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'royalblog_scripts', 20 );

function royalblog_scripts() {
    
    global $royalblog_version;
    
    wp_dequeue_style( 'craft-blog-style' );
    
	wp_enqueue_style( 'royalblog-parent-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/style.css', array(), esc_attr( $royalblog_version ) );

    wp_enqueue_style( 'royalblog-style', get_stylesheet_uri(), array(), esc_attr( $royalblog_version ) );

    //Load Custom JavScript Library File
    wp_enqueue_script( 'royalblog-custom', trailingslashit( esc_url ( get_stylesheet_directory_uri() ) ) . '/js/royalblog-custom.js', array('jquery','jquery-ui-tabs' ) );
    
    $royalblog_primary_theme_color = get_theme_mod( 'royalblog_primary_theme_color_options', '#b565a7' );
    
    $output_css = '';
    

    $output_css .= ".sociallink ul li a, .btn.btn-primary, .lSAction>a:hover, .calendar_wrap caption, .wpcf7 input[type='submit'], .wpcf7 input[type='button'], .aboutAuthor .infos .btns .btn.btn-color-full:hover, button, input[type='button'], input[type='reset'], input[type='submit'], .reply .comment-reply-link, .page-header span, .widget_search .search-submit, .widget_product_search input[type='submit'], .nav-menu > li.current-menu-item:after, .features-promo-link .promo-banner-img .promo-banner-img-inner .promo-img-info .promo-img-info-inner h3, .page-numbers, .goToTop{ background-color: ". esc_attr( $royalblog_primary_theme_color ) ."}\n";
   
    $output_css .= ".sociallink ul li a:hover, .main-navigation .current-menu-item a, .main-navigation a:hover, .ol-fullslider .ol-caption h2 a:hover, .ol-fullslider .ol-caption .entry-meta div:hover, .ol-fullslider .ol-caption .entry-meta.info div a:hover, .btn.btn-primary:hover, .article .title:hover a, .widget a:hover, .widget a:hover::before, .widget li:hover::before, .page-numbers.current, .page-numbers:hover, .footer-socials a:hover, .footer-copyright a:hover, .scrolltop:hover, .scrolltop, .breadcrumbs .trail-items li a, .wpcf7 input[type='submit']:hover, .wpcf7 input[type='button']:hover, .prevNextArticle a:hover, .logged-in-as a, button, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover, .not-found .page-header h1, .footer-widgets .widget a:hover, .footer-widgets .widget a:hover::before, .footer-widgets .widget li:hover::before{ color: ". esc_attr( $royalblog_primary_theme_color ) ."}\n";
    
    $output_css .= ".sociallink ul li a, .sociallink ul li a:hover, .btn.btn-primary, .btn.btn-primary:hover, .wpcf7 input[type='submit'], .wpcf7 input[type='button'], .wpcf7 input[type='submit']:hover, .wpcf7 input[type='button']:hover, .aboutAuthor .infos .btns .btn.btn-color-full:hover, .prevNextArticle .hoverExtend.active span, button, input[type='button'], input[type='reset'], input[type='submit'], button, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover, .footer-widgets .widget h2.widget-title:before, .page-numbers, .page-numbers:hover, .sidebar-popup-wrap .widget .widget-title, .widget-area .widget .widget-title{ border-color: ". esc_attr( $royalblog_primary_theme_color ) ."}\n";
                
    wp_add_inline_style( 'royalblog-style', $output_css );
    
}