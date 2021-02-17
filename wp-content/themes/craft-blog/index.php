<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Craft_Blog
 */

$mainslider = get_theme_mod( 'craft_blog_slider_section_options', 'on' );

$layout = get_theme_mod( 'craft_blog_blog_display_layout_options', 'grid-rsidebar' );

get_header(); ?>

<?php if( !empty( $mainslider ) && $mainslider == 'on' ){ ?>	

	<div class="owl-carousel owl-theme ol-slider">
		<?php
			$category = get_theme_mod( 'craft_blog_slider_term_id', 1 ) ;
			$number_post = get_theme_mod( 'craft_blog_number_post_slider_options', 5 ) ;

			$catid = explode(',', $category);

			$args = array(
	            'post_type' => 'post',
	            'posts_per_page' => $number_post,
	            'tax_query' => array(
	                array(
	                    'taxonomy' => 'category',
	                    'field' => 'term_id',
	                    'terms' => $catid
	                ),
	            ),
	        );

	        $query = new WP_Query( $args ); while ( $query->have_posts() ) { $query->the_post();
		?>
			<div class="ol-slider-panel">
				<article class="ol-caption">
					<?php 

						the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

						if ( 'post' === get_post_type() ) :
							?>
							<div class="entry-meta info">
								<?php
									craft_blog_posted_on();
									craft_blog_posted_by();
									craft_blog_comments();
								?>
							</div><!-- .entry-meta -->
					<?php endif; ?>
					<p>
						<a href="<?php the_permalink(); ?>" class="btn btn-primary">
							<?php echo esc_html( get_theme_mod( 'craft_blog_post_continue_reading_text', 'Continue Reading' ) ); ?>
						</a>
					</p>
				</article>
				<div class="ol-img-holder">
					<?php
						the_post_thumbnail( 'craft-blog-slider' );
					?>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area col-xs-12 col-sm-8 <?php echo esc_attr( $layout  ); ?>" data-layout="<?php echo esc_attr( $layout  ); ?>">
			<main id="main" class="site-main">
				<div class="articlesListing blog-grid">	
					<?php
						if ( have_posts() ) :


							if( !empty( $layout ) && $layout == 'masonry2-rsidebar'){

								echo '<div class="craftblog-masonry">';
							}

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */

									// Post Display Layout
									if( !empty( $layout ) && $layout == 'list-rsidebar' ){

										get_template_part( 'template-parts/layout/content', 'list' );

									}else if( !empty( $layout ) && $layout == 'gridcol2-rsidebar' ){
										
										get_template_part( 'template-parts/layout/content', 'twogrid' );
			
									}else if( !empty( $layout ) && $layout == 'masonry2-rsidebar' ){
										
										get_template_part( 'template-parts/layout/content', 'masonry' );
			
									}else {

										get_template_part( 'template-parts/content', get_post_format() );

									}

								endwhile;

							if( !empty( $layout ) && $layout == 'masonry2-rsidebar'){

								echo '</div>';
							}

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
