<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Craft_Blog
 */

$post_sidebar =  get_theme_mod( 'craft_blog_default_post_sidebar', 'rightsidebar' );

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

							$authoroptions = get_theme_mod( 'craft_blog_author_posts_option', 'on' );
							
							if( !empty( $authoroptions ) && $authoroptions == 'on' ){
								/**
								 * displaying author bio
								 */
								get_template_part( 'template-parts/content', 'author' );
							}

							?>	
								
								<div class="prevNextArticle box">
									<div class="row">
										<div class="col-xs-6">
											<?php previous_post_link( '%link', '<div class="hoverExtend active"><span>'.esc_html__('Previous article','craft-blog').'</span></div><div class="title">%title</div>' ); ?>
										</div>
										<div class="col-xs-6">
											<?php next_post_link( '%link', '<div class="hoverExtend active"><span>'.esc_html__('Next article','craft-blog').'</span></div><div class="title">%title</div>' ); ?>
										</div>
									</div>
								</div><!-- Previous / next article -->

							<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

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
