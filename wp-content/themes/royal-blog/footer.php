<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Craft_Blog
 */

?>

</div><!-- #content -->

	<footer id="page-footer" class="site-footer clearfix">

		<a class="goToTop" href="#" id="scrollTop">
			<i class="fa fa-angle-up"></i>
			<span><?php esc_html_e('Top','royal-blog'); ?></span>
		</a>
		
		<div class="footer-socials">
	    	<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<?php
							$get_social_media_icons = get_theme_mod( 'craft_blog_social_media_icons', '' );
					        $get_decode_social_media = json_decode( $get_social_media_icons ); 

					        if( !empty( $get_decode_social_media ) ) {   
				              	foreach ( $get_decode_social_media as $single_icon ) {

				                  	$icon_class = $single_icon->social_icon_class;
				                  	$iconclass      = preg_replace( array("/fa /", "/fa-/"),"",$icon_class );
				                  	$icon_url = $single_icon->social_icon_url;

				                    if( !empty( $icon_url ) ) {
										echo '<a href="'. esc_url( $icon_url ) .'" target="_blank">
												<span class="footer-socials-icon"><i class="'. esc_html( $icon_class ) .'"></i></span><span>'. esc_html( $iconclass ) .'</span></a>';
				                    }
				              	}
				            }
				        ?>
				    </div>
				</div>
			</div>
	    </div><!-- .footer-socials -->

		<div class="footer-widgets clearfix">
			<div class="footer-inner-wrap container">
				<div class="row">
					<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
					<?php } ?>

					<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
					<?php } ?>

					<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
						<div class="col-xs-12 col-sm-12 col-md-4">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

	    <div class="footer-copyright">
	        <div class="page-footer-inner container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
			            <div class="copyright-info">
			                <?php do_action( 'craft_blog_copyright', 5 ); ?>  <?php the_privacy_policy_link(); ?>
			            </div><!-- Copyright -->
			        </div>
		        </div>
	        </div>
	    </div><!-- .footer-copyright -->

	</footer>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
