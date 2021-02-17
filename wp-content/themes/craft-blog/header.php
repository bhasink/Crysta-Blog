<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Craft_Blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site pagewrap">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'craft-blog' ); ?></a>

	<header id="masthead" class="site-header">
		<?php 
			$topheader = get_theme_mod( 'craft_blog_top_header_section_options' , 'on' );
			if( !empty( $topheader ) && $topheader == 'on' ){
		?>
			<div class="top-header">
				<div class="container">
					<div class="row">

						<div class="col-xs-12 col-sm-7 col-md-8">
							<nav id="sitenavigation" class="main-navigation">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'menu-2',
										'menu_id'        => 'top-menu',
									) );
								?>
							</nav><!-- #site-navigation -->
						</div>
						
						<div class="col-xs-12 col-sm-5 col-md-4">
							<?php
                        		/**
                        		 * Social Media Link
                        		*/
                        		do_action( 'craft_blog_social_media', 5 );
                        	?>
					    </div>
					</div>
				</div>
			</div>

		<?php } ?>

		<div class="main-header">
			<div class="logo-outer">
				<div class="logo-inner">
					<div class="header-logo site-branding">
						<div class="container">

							<?php the_custom_logo(); ?>

							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>

							<?php 
								$xpressstore_description = get_bloginfo( 'description', 'display' );
								if ( $xpressstore_description || is_customize_preview() ) :?>
									<p class="site-description"><?php echo $xpressstore_description; /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>	
						</div>				
					</div> <!-- .site-branding -->
				</div><!-- .logo-inner -->
			</div><!-- .logo-outer -->
		</div><!-- .main-header -->

		<div class="navbar navbar-inverse">
			<div class="container">
				<nav id="site-navigation" class="main-navigation text-<?php echo esc_attr( get_theme_mod( 'craft_blog_main_nav_align','center' ) ); ?>">				
					<div class="navbar-header">
						<button type="button" class="navbar-toggle menu-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div> <!-- Mobile navbar toggler -->
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>

	</header><!-- #masthead -->

	<?php

		if( ! is_front_page() || ! is_home() ) {
            /**
    		 * craft_blog_breadcrumb_header hook
    		 *
    		 * @since 1.0.0
    		 */
    		do_action( 'craft_blog_breadcrumb_header' );
        }
	?>

	<div id="content" class="site-content">


