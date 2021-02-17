<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Craft_Blog
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area col-xs-12 col-sm-8">
			<main id="main" class="site-main">
				<div class="articlesListing">	
					<?php if ( have_posts() ) : ?>
						
						<header class="page-header">
							<h2 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'craft-blog' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h2>
						</header><!-- .page-header -->

						<?php	
						/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );

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

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer();
