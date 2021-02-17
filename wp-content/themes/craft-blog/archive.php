<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Craft_Blog
 */

$post_sidebar =  get_theme_mod( 'craft_blog_archive_sidebar', 'rightsidebar' );

get_header(); ?>

	<div class="container">
		<div class="row">

			<?php if( $post_sidebar == 'leftsidebar' && is_active_sidebar('sidebar-2')){ get_sidebar('left'); } ?>

			<div id="primary" class="content-area col-xs-12 col-sm-8">
				<main id="main" class="site-main">
					<div class="articlesListing">	
						<?php
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_format() );

								endwhile;

								the_posts_pagination( 
				            		array(
									    'prev_text' => esc_html__( 'Prev', 'craft-blog' ),
									    'next_text' => esc_html__( 'Next', 'craft-blog' ),
									)
					            );

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;
						?>
					</div><!-- Articales Listings -->

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php if( $post_sidebar == 'rightsidebar' && is_active_sidebar('sidebar-1')){ get_sidebar(); } ?>
			
		</div>
	</div>

<?php get_footer();