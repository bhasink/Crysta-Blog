<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Craft_Blog
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<div id="primary" class="content-area col-xs-12 col-sm-12 col-md-12">
			<main id="main" class="site-main">
				<div class="articlesListing">

					<section class="error-404 not-found">
			
						<header class="page-header">
							<h1><?php esc_html_e('404','craft-blog'); ?></h1>
							<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'craft-blog' ); ?></h2>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'craft-blog' ); ?></p>							
						</div><!-- .page-content -->

						<div class="btns text-center">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
								<span><?php esc_html_e('Back To Home','craft-blog'); ?></span>
							</a>
						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</div>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</div>

<?php
get_footer();
