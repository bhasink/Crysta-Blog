<?php
/**
 * Add ABout Theme Page
*/
function craftblog_about_page() {
	add_theme_page( esc_html__( 'About Craft Blog', 'craft-blog' ), esc_html__( 'About Craft Blog', 'craft-blog' ), 'edit_theme_options', 'about-craftblog', 'craftblog_about_page_output' );
}
add_action( 'admin_menu', 'craftblog_about_page' );


/**
 * Render About Themes HTML
*/
function craftblog_about_page_output() {
	$theme_data	 = wp_get_theme();
?>
	<div class="wrap">
		<h1>
			<?php /* translators: %s theme name */
				printf( esc_html__( 'Welcome to %s', 'craft-blog' ), esc_html( $theme_data->Name ) );
			?>
		</h1>
		<p class="welcome-text">
			<?php /* translators: %s theme name */
					printf( esc_html__( '%s is a clean, sleek modern, stylish and beautiful free WordPress blog theme, Craft Blog perfect for lifestyle & travel bloggers, style guides, personal blogging, journal, music band & singers, photographers, writers, fashion designer, interior designers, wedding, eCommerce and more. Craft Blog is a modern theme with elegant design and is completely built on Customizer which allows you to customize theme settings easily with live previews. Craft Blog fully responsive, cross-browser compatible, translation ready and search engine optimized ( SEO ) friendly clean and modern design theme.', 'craft-blog' ), esc_html( $theme_data->Name ) );
				?>
				<br><br><a href="<?php echo esc_url('http://demo.sparklewpthemes.com/craftblogpro/'); ?>" class="button button-primary button-hero" target="_blank"><?php esc_html_e( 'Theme Demo Preview', 'craft-blog' ); ?></a>
		</p><br>
		<?php
			/**
			 * Active Tab
			*/
			if ( isset($_GET[ 'tab' ]) ) {
				$active_tab = sanitize_key($_GET[ 'tab' ]);
			} else {
				$active_tab = 'craftblog_tab_1';
			}
		?>
		<div class="nav-tab-wrapper">
			<a href="?page=about-craftblog&tab=craftblog_tab_1" class="nav-tab <?php echo $active_tab == 'craftblog_tab_1' ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Getting Started', 'craft-blog' ); ?>
			</a>
			<a href="?page=about-craftblog&tab=craftblog_tab_2" class="nav-tab <?php echo $active_tab == 'craftblog_tab_2' ? 'nav-tab-active' : ''; ?>">
				<span class="dashicons dashicons-video-alt3"></span><?php esc_html_e( 'Video Tutorials', 'craft-blog' ); ?>
			</a>
			<a href="?page=about-craftblog&tab=craftblog_tab_3" class="nav-tab <?php echo $active_tab == 'craftblog_tab_3' ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Useful Plugins', 'craft-blog' ); ?>
			</a>
			<a href="?page=about-craftblog&tab=craftblog_tab_4" class="nav-tab <?php echo $active_tab == 'craftblog_tab_4' ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Support', 'craft-blog' ); ?>
			</a>
			<a href="?page=about-craftblog&tab=craftblog_tab_5" class="nav-tab <?php echo $active_tab == 'craftblog_tab_5' ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Free vs Pro', 'craft-blog' ); ?>
			</a>
		</div>

		<?php if ( $active_tab == 'craftblog_tab_1' ) : ?>
			<div class="three-columns-wrap">
				<br>
				<div class="column-width-3">
					<h3><?php esc_html_e( 'Documentation', 'craft-blog' ); ?></h3>
					<p>
						<?php /* translators: %s theme name */
							printf( esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use %s.', 'craft-blog' ), esc_html( $theme_data->Name ) );
						?>
					</p>
					<a target="_blank" href="#" class="button button-primary"><?php esc_html_e( 'Read Full Documentation', 'craft-blog' ); ?></a>
				</div>

				<div class="column-width-3">
					<h3><?php esc_html_e( 'Demo Content', 'craft-blog' ); ?></h3>
					<p>
						<?php esc_html_e( 'Install the Demo Content in 2 clicks. Just click the button below to install demo import plugin and wait a bit to be redirected to the demo import page.', 'craft-blog' ); ?>
					</p>
					<?php if ( is_plugin_active( 'one-click-demo-import/one-click-demo-import.php' ) ) : ?>
						<a href="<?php echo esc_url( admin_url( '/themes.php?page=pt-one-click-demo-import' ) ); ?>" class="button button-primary demo-import"><?php esc_html_e( 'Go to Import page', 'craft-blog' ); ?></a>
					<?php elseif ( craftblog_check_installed_plugin( 'one-click-demo-import', 'one-click-demo-import' ) ) : ?>
						<button class="button button-primary demo-import" id="craftblog-demo-content-act"><?php esc_html_e( 'Activate Demo Import Plugin', 'craft-blog' ); ?></button>
					<?php else: ?>
						<button class="button button-primary demo-import" id="craftblog-demo-content-inst"><?php esc_html_e( 'Install Demo Import Plugin', 'craft-blog' ); ?></button>
					<?php endif; ?>
					<a href="#" target="_blank" class="button button-primary import-video"><span class="dashicons dashicons-video-alt3"></span><?php esc_html_e( 'Video Tutorial', 'craft-blog' ); ?></a>
				</div>

				<div class="column-width-3">
					<h3><?php esc_html_e( 'Theme Customizer', 'craft-blog' ); ?></h3>
					<p>
						<?php /* translators: %s theme name */
							printf( esc_html__( '%s supports the Theme Customizer for all theme settings. Click "Customize" to personalize your site.', 'craft-blog' ), esc_html( $theme_data->Name ) );
						?>
					</p>
					<a target="_blank" href="<?php echo esc_url( wp_customize_url() );?>" class="button button-primary"><?php esc_html_e( 'Start Customizing', 'craft-blog' ); ?></a>
				</div>

			</div>

			<!-- Predefined Styles -->
			<div class="four-columns-wrap">
				<hr>
			
				<h2><?php esc_html_e( 'Craft Blog Pro - Predefined Styles', 'craft-blog' ); ?></h2>
				<p></p>
				<div class="column-width-4">
					<div class="active-style"><?php esc_html_e( 'Active', 'craft-blog' ); ?></div>
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/craftblogpro.jpg'; ?>" alt="">
					<div>
						<h2><?php esc_html_e( 'Main', 'craft-blog' ); ?></h2>
						<a href="<?php echo esc_url('http://demo.sparklewpthemes.com/craftblogpro/'); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Live Preview', 'craft-blog' ); ?></a>
					</div>
				</div>

				<div class="column-width-4">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/craftblogpro-food.jpg'; ?>" alt="">
					<div>
						<h2><?php esc_html_e( 'Food', 'craft-blog' ); ?></h2>
						<a href="<?php echo esc_url('http://demo.sparklewpthemes.com/craftblogpro/food/'); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Live Preview', 'craft-blog' ); ?></a>
					</div>
				</div>
				<div class="column-width-4">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/craftblogpro-lifestyle.jpg'; ?>" alt="">
					<div>
						<h2><?php esc_html_e( 'Lifestyle', 'craft-blog' ); ?></h2>
						<a href="<?php echo esc_url('http://demo.sparklewpthemes.com/craftblogpro/lifestyle/'); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Live Preview', 'craft-blog' ); ?></a>
					</div>
				</div>
				<div class="column-width-4">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/craftblogpro-sport.jpg'; ?>" alt="">
					<div>
						<h2><?php esc_html_e( 'Sport', 'craft-blog' ); ?></h2>
						<a href="<?php echo esc_url('http://demo.sparklewpthemes.com/craftblogpro/sport/'); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Live Preview', 'craft-blog' ); ?></a>
					</div>
				</div>	
				<div class="column-width-4">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/craftblogpro-tech.jpg'; ?>" alt="">
					<div>
						<h2><?php esc_html_e( 'Technology', 'craft-blog' ); ?></h2>
						<a href="<?php echo esc_url('http://demo.sparklewpthemes.com/craftblogpro/technology/'); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Live Preview', 'craft-blog' ); ?></a>
					</div>
				</div>
				<div class="column-width-4">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/coming-soon.jpg'; ?>" alt="">
					<div>
						<h2><?php esc_html_e( 'Dark', 'craft-blog' ); ?></h2>
						<a href="<?php echo esc_url('http://demo.sparklewpthemes.com/craftblogpro/sample-v1/'); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'Live Preview', 'craft-blog' ); ?></a>
					</div>
				</div>

			</div>
		
		<?php elseif ( $active_tab == 'craftblog_tab_2' ) : ?>

			<div class="four-columns-wrap video-tutorials">

				<div class="column-width-4">
					<h3><?php esc_html_e( 'Demo Content', 'craft-blog' ); ?></h3>
					<a class="button button-primary" target="_blank" href="h#"><?php esc_html_e( 'Watch Video', 'craft-blog' ); ?></a>
					<a class="button button-secondary" href="<?php echo esc_url(admin_url('themes.php?page=about-craftblog&tab=craftblog_tab_1')); ?>"></span><?php esc_html_e( 'Get Started', 'craft-blog' ); ?></a>
				</div>

			</div>

		<?php elseif ( $active_tab == 'craftblog_tab_3' ) : ?>
			
			<div class="three-columns-wrap">
				<br><br>
				<?php
					// WooCommerce
					craftblog_recommended_plugin( 'woocommerce', 'woocommerce' );

					// MailPoet 2
					craftblog_recommended_plugin( 'wysija-newsletters', 'index' );

					// Contact Form 7
					craftblog_recommended_plugin( 'contact-form-7', 'wp-contact-form-7' );

					// Ajax Thumbnail Rebuild
					craftblog_recommended_plugin( 'ajax-thumbnail-rebuild', 'ajax-thumbnail-rebuild' );

					// Facebook Widget
					craftblog_recommended_plugin( 'facebook-pagelike-widget', 'facebook_widget' );
				?>
			</div>

		<?php elseif ( $active_tab == 'craftblog_tab_4' ) : ?>

			<div class="three-columns-wrap">
				<br>
				<div class="column-width-3">
					<h3>
						<span class="dashicons dashicons-sos"></span>
						<?php esc_html_e( 'Forums', 'craft-blog' ); ?>
					</h3>
					<p>
						<?php esc_html_e( 'Before asking a questions it\'s highly recommended to search on forums, but if you can\'t find the solution feel free to create a new topic.', 'craft-blog' ); ?>
						<hr>
						<a target="_blank" href="<?php echo esc_url('https://sparklewpthemes.com/support/forum/wordpress-themes/free-themes/craft-blog/'); ?>"><?php esc_html_e( 'Go to Support Forums', 'craft-blog' ); ?></a>
					</p>
				</div>

				<div class="column-width-3">
					<h3>
						<span class="dashicons dashicons-admin-tools"></span>
						<?php esc_html_e( 'Changelog', 'craft-blog' ); ?>
					</h3>
					<p>
						<?php esc_html_e( 'Want to get the gist on the latest theme changes? Just consult our changelog below to get a taste of the recent fixes and features implemented.', 'craft-blog' ); ?>
						<hr>
						<a target="_blank" href="<?php echo esc_url('https://sparklewpthemes.com/update-logs/craft-blog-update-logs/'); ?>"><?php esc_html_e( 'Changelog', 'craft-blog' ); ?></a>
					</p>
				</div>

			</div>

		<?php elseif ( $active_tab == 'craftblog_tab_5' ) : ?>

			<table class="free-vs-pro form-table">
				<thead>
					<tr>
						<th>
							<a href="<?php echo esc_url('https://sparklewpthemes.com/wordpress-themes/craftblogpro/'); ?>" target="_blank" class="button button-primary button-hero">
								<?php esc_html_e( 'Get Craft Blog Pro', 'craft-blog' ); ?>
							</a>
						</th>
						<th class="compare-icon"><?php esc_html_e( 'Craft Blog', 'craft-blog' ); ?></th>
						<th class="compare-icon"><?php esc_html_e( 'Craft Blog Pro', 'craft-blog' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<h3><?php esc_html_e( '800+ Google Fonts', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Header Background Image/Color/Video', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Unlimited Colors Options', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Classic, List, Grid Post Layouts', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Advanced Slider Options', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'WooCommerce Support', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Promo Section', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Custom Widget', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Pre Loader', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-no"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Sticky Navigation', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Sticky Sidebar', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>
					<tr>
						<td>
							<h3><?php esc_html_e( 'Premium Support 24/7', 'craft-blog' ); ?></h3>
						</td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
						<td class="compare-icon"><span class="dashicons-before dashicons-yes"></span></td>
					</tr>

					<tr>
						<td colspan="3">
							<a href="<?php echo esc_url('https://sparklewpthemes.com/wordpress-themes/craftblogpro/'); ?>" target="_blank" class="button button-primary button-hero">
								<strong><?php esc_html_e( 'View Full Feature List', 'craft-blog' ); ?></strong>
							</a>
						</td>
					</tr>
				</tbody>
			</table>

	    <?php endif; ?>

	</div><!-- /.wrap -->
<?php
} // end craftblog_about_page_output

// Check if plugin is installed
function craftblog_check_installed_plugin( $slug, $filename ) {
	return file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $filename . '.php' ) ? true : false;
}

// Generate Recommended Plugin HTML
function craftblog_recommended_plugin( $slug, $filename ) {

	$plugin_info = craftblog_call_plugin_api( $slug );
	$plugin_desc = $plugin_info->short_description;
	$plugin_img  = ( ! isset($plugin_info->icons['1x']) ) ? $plugin_info->icons['default'] : $plugin_info->icons['1x'];
?>

	<div class="plugin-card">
		<div class="name column-name">
			<h3>
				<?php echo esc_html( $plugin_info->name ); ?>
				<img src="<?php echo esc_url( $plugin_img ); ?>" class="plugin-icon" alt="">
			</h3>
		</div>
		<div class="action-links">
			<?php if ( craftblog_check_installed_plugin( $slug, $filename ) ) : ?>
			<button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e( 'Installed', 'craft-blog' ); ?></button>
			<?php else : ?>
			<a class="install-now button-primary" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='. $slug ), 'install-plugin_'. $slug ) ); ?>" >
				<?php esc_html_e( 'Install Now', 'craft-blog' ); ?>
			</a>							
			<?php endif; ?>
		</div>
		<div class="desc column-description">
			<p><?php echo esc_html( $plugin_desc ) . esc_html__( '...', 'craft-blog' ); ?></p>
		</div>
	</div>

<?php
}

// Get Plugin Info
function craftblog_call_plugin_api( $slug ) {

	$call_api = get_transient( 'craftblog_about_plugin_info_' . $slug );

	if ( false === $call_api ) {

	    if ( ! function_exists( 'plugins_api' ) && file_exists( trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin-install.php' ) ) {
	        require_once( trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin-install.php' );
	    }

	    if ( function_exists( 'plugins_api' ) ) {

			$call_api = plugins_api(
				'plugin_information', array(
					'slug'   => $slug,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => true,
						'homepage'          => true,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => true,
					),
				)
			);

			if ( ! is_wp_error( $call_api ) ) {
				set_transient( 'craftblog_about_plugin_info_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
			}

		}
	}

	return $call_api;
}


// enqueue ui CSS/JS
function craftblog_enqueue_about_page_scripts($hook) {

	if ( 'appearance_page_about-craftblog' != $hook ) {
		return;
	}

	wp_enqueue_style( 'craft-blog-about-css', get_theme_file_uri( '/inc/about/css/about-page.css' ), array() );
	wp_enqueue_script( 'plugin-install' );
	wp_enqueue_script( 'updates' );
	wp_enqueue_script( 'craft-blog-about-page-css', get_theme_file_uri( '/inc/about/js/about-craftblog-page.js' ), array() );

}
add_action( 'admin_enqueue_scripts', 'craftblog_enqueue_about_page_scripts' );


// Install/Activate Demo Import Plugin 
function craftblog_plugin_auto_activation() {

	// Get the list of currently active plugins (Most likely an empty array)
	$active_plugins = (array) get_option( 'active_plugins', array() );

	array_push( $active_plugins, 'one-click-demo-import/one-click-demo-import.php' );

	// Set the new plugin list in WordPress
	update_option( 'active_plugins', $active_plugins );

}
add_action( 'wp_ajax_craftblog_plugin_auto_activation', 'craftblog_plugin_auto_activation' );


// Import Plugin Data
function craftblog_import_demo_files() {
	return array(
		array(
			'import_file_name'             => esc_html__( 'Import Demo Data', 'craft-blog' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/about/import/craftblog-demo.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/about/import/craftblog-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/about/import/craftblog-customizer.dat'
		)
	);
}
add_filter( 'pt-ocdi/import_files', 'craftblog_import_demo_files' );

// Install Menus after Import
function craftblog_after_import_setup() {
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'menu-1' => $main_menu->term_id,
			'menu-2'  => $top_menu->term_id,
		)
	);
}
add_action( 'pt-ocdi/after_import', 'craftblog_after_import_setup' );

// Disable PT Branding after Import Notice
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );