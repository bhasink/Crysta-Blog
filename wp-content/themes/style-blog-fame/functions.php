<?php
/**
 * Style Blog Fame theme functions.
 *
 * Functions file for child theme, enqueues parent and child stylesheets by default.
 *
 * @since	1.0.0
 * @package Style Blog Fame
 */

// Exit if accessed directly.

if ( ! defined( 'ABSPATH' ) ) {

	exit;
}

// Add enqueue function to the desired action.

add_action( 'wp_enqueue_scripts', 'style_blog_fame_enqueue_styles', 20 );

if ( ! function_exists( 'style_blog_fame_enqueue_styles' ) ) {
	/**
	 * Enqueue Styles.
	 *
	 * Enqueue parent style and child styles where parent are the dependency
	 * for child styles so that parent styles always get enqueued first.
	 *
	 * @since 1.0.0
	 */

	function style_blog_fame_enqueue_styles() {

		wp_enqueue_style( 'style-blog-fame-parent-style', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'style-blog-fame-parent-main', get_template_directory_uri() . '/themebeez/assets/dist/css/main.min.css' );

		wp_enqueue_style( 'style-blog-fame-fonts', style_blog_fame_fonts_url() );

		wp_enqueue_style( 'style-blog-fame-child-main', get_stylesheet_directory_uri() . '/assets/dist/css/main.css', 'style-blog-fame-parent-style', wp_get_theme()->get('Version') );

		wp_enqueue_script( 'style-blog-child-fame-bundle', get_stylesheet_directory_uri() . '/assets/dist/js/bundle.min.js', array( 'jquery' ), '1.0.0', true );
	}
}


/**
===========================================
=
= Get google font 
=
===============================================================
*/
if ( !function_exists( 'style_blog_fame_fonts_url' ) ) :

    /**
     * Return Font's URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */

    function style_blog_fame_fonts_url()

    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

        if ('off' !== _x('on', 'Oswald font: on or off', 'style-blog-fame')) {
            $fonts[] = 'Oswald:400,500,600,700';
        }

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

        if ('off' !== _x('on', 'Pacifico font: on or off', 'style-blog-fame')) {
            $fonts[] = 'Pacifico:400';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;



/**
===============================
=
= Featured banner hook
=
=====================================
*/
if( ! function_exists( 'style_blog_fame_featured_slider_action' ) ) :
	/**
     * Featured Slider Declaration
     *
     * @since 1.0.0
     */
	function style_blog_fame_featured_slider_action() {
		
		$enable_slider 	 = styleblog_get_option( 'styleblog_enable_feat_slider' );
		$slider_post_cat = styleblog_get_option( 'styleblog_featured_post_cat' );
		$slider_post_no  = styleblog_get_option( 'styleblog_featured_post_no' );

		$slider_args = array(

			'post_type'			=> 'post',
			'cat'				=> absint( $slider_post_cat ),
			'posts_per_page'	=> absint( $slider_post_no ),
		);
		$slider_query = new WP_Query( $slider_args );

		if( $enable_slider == 1 && $slider_query->have_posts() ) :
		?>
		<section class="featured_posts">
			<div class="featured_posts_inner">
				<div class="owl-carousel" id="style-blog-fame-hero-slider">
					<?php
					while( $slider_query->have_posts() ) :
						$slider_query->the_post();

						$feature_image 	 = get_the_post_thumbnail_url( get_the_ID(), 'full');
				 		?>
						<div class="item">
							<?php
							if( has_post_thumbnail() ) :
								?>
								<div class="fp_featured_image" style="background-image:url(<?php if( !empty( $feature_image ) ) { echo $feature_image; } ?>);">
									<div class="fp_content_holder">
										<div class="fp_category">
											<?php
												/* translators: used between list items, there is a space after the comma */
												$categories_list = get_the_category_list( esc_html__( ' ', 'style-blog-fame' ) );			
												if ( $categories_list ) {
													/* translators: 1: list of categories. */
													printf( '<span class="cat-links">' . esc_html__( ' %1$s', 'style-blog-fame' ) . '</span>', $categories_list ); // WPCS: XSS OK.
												}
											?>
										</div>
										<div class="fp_content">
											<div class="title">
												<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											</div><!-- // title -->
											<div class="post_meta">
												<?php
													styleblog_get_post_date();
													styleblog_get_comments_no();
												?>
											</div><!-- // post_meta -->
										</div>
									</div><!-- // fp_content_holder -->
								</div>
								<?php
							endif;
							?>
						</div><!-- // item -->
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
		<?php	
		endif;	
	}
endif;
add_action( 'style_blog_fame_featured_slider', 'style_blog_fame_featured_slider_action', 10 );