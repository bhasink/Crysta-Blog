<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Craft_Blog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function craft_blog_body_classes( $classes ) {
  	// Adds a class of hfeed to non-singular pages.
  	if ( ! is_singular() ) {
  		$classes[] = 'hfeed';
  	}

    //Web Page Layout
    if( get_theme_mod( 'craft_blog_website_layout_options', 'fullwidth' ) == 'boxed') {
      $classes[] = 'boxed';
    }
  	// Adds a class of no-sidebar when there is no sidebar present.
  	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
  		$classes[] = 'no-sidebar';
  	}

  	return $classes;
}
add_filter( 'body_class', 'craft_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function craft_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'craft_blog_pingback_header' );



/**
 * Social Media Link
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'craft_blog_social_media_link' ) ){

    function craft_blog_social_media_link() {

        $get_social_media_icons = get_theme_mod( 'craft_blog_social_media_icons', '' );
        $get_decode_social_media = json_decode( $get_social_media_icons ); 

        if( !empty( $get_decode_social_media ) ) {

          echo '<div class="sociallink"><ul>';    
              foreach ( $get_decode_social_media as $single_icon ) {
                  $icon_class = $single_icon->social_icon_class;
                  $icon_url = $single_icon->social_icon_url;
                  if( !empty( $icon_url ) ) {

                      echo '<li><a href="'. esc_url( $icon_url ) .'" target="_blank"><i class="'. esc_html( $icon_class ) .'"></i></a></li>';
                  }
              }

          echo '</ul></div>';
        } 
    }
}
add_action( 'craft_blog_social_media', 'craft_blog_social_media_link', 5 );


/**
 * Footer Copyright Information
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'craft_blog_footer_copyright' ) ){

    function craft_blog_footer_copyright() {

        $copyright = get_theme_mod( 'craft_blog_footer_section_options' ); 

        if( !empty( $copyright ) ) { 

            echo esc_html ( apply_filters( 'craft_blog_copyright_text', $copyright ) ); 

        } else { 

            echo esc_html( apply_filters( 'craft_blog_copyright_text', $content = esc_html__('Copyright  &copy; ','craft-blog') . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) .' - ' ) );
        }

        printf( ' WordPress Theme : By %1$s', '<a href=" ' . esc_url('https://sparklewpthemes.com/') . ' " rel="designer" target="_blank">'.esc_html__('Sparkle Themes','craft-blog').'</a>' );
    }
}
add_action( 'craft_blog_copyright', 'craft_blog_footer_copyright', 5 );


/**
 * Posts format declaration function.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'craft_blog_post_format_media' ) ) :
    
    function craft_blog_post_format_media( $postformat ) {

        $layout = get_theme_mod( 'craft_blog_blog_display_layout_options', 'grid-rsidebar' );

        if( is_singular( ) ){

          $imagesize = 'post-thumbnail';

        }else{

            if( !empty( $layout ) && $layout == 'list-rsidebar' ){

                $imagesize = 'craft-blog-list-post';

            }else{

                $imagesize = 'post-thumbnail';

            }
        }

        if( $postformat == "gallery" ) {

            $gallery                = get_post_gallery( get_the_ID(), false );
            $gallery_attachment_ids = explode( ',', $gallery['ids'] );
            
            if( is_array( $gallery ) ){ ?>

                <div class="postgallery-carousel cS-hidden">
                    <?php foreach ( $gallery_attachment_ids as $gallery_attachment_id ) { ?>
                        <div class="list">
                            <?php echo wp_get_attachment_image( $gallery_attachment_id, $imagesize ); // WPCS xss ok. ?>
                        </div>
                    <?php } ?>
                </div>

            <?php }else{  the_post_thumbnail( $imagesize ); }
            
        }else if( $postformat == "video" ){
            
            $get_content  = apply_filters( 'the_content', get_the_content() );
            $get_video    = get_media_embedded_in_content( $get_content, array( 'video', 'object', 'embed', 'iframe' ) );

            if( !empty( $get_video ) ){ ?>

                <div class="video">
                    <?php echo $get_video[0]; // WPCS xss ok. ?>
                </div>

            <?php }else{  the_post_thumbnail( $imagesize ); }


        }else if( $postformat == "audio" ){

            $get_content  = apply_filters( 'the_content', get_the_content() );
            $get_audio    = get_media_embedded_in_content( $get_content, array( 'audio', 'iframe' ) );

            if( !empty( $get_audio ) ){ ?>

                <div class="audio">
                    <?php echo $get_audio[0]; // WPCS xss ok. ?>
                </div>

            <?php }else{  the_post_thumbnail( $imagesize ); }

        }else if( $postformat == "quote" ) { ?>

            <div class="post-format-media--quote">
                <?php the_content(); ?>
            </div>

        <?php 

        }else{ ?>
            <div class="image">
                <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                    <?php
                      the_post_thumbnail( $imagesize );
                    ?>
                </a>
            </div>
        <?php }

    }

endif;


/**
 * Posts & page breadcrumb declaration function.
 *
 * @since 1.0.0
 */

if( ! function_exists( 'craft_blog_breadcrumb_header_title' ) ) :

    /**
    * function display page & post title with breadcrumb menu.
    *
    */
    function craft_blog_breadcrumb_header_title() { ?>

      <div class="custom-header">
          <div class="container">
              <div class="row">
                  <div class="ccol-xs-12 col-sm-12 col-md-12">
                      <?php 
                          if( is_single() || is_page() ) {

                              the_title( '<h2 class="entry-title">', '</h2>' );

                          } elseif( is_archive() ) {

                              the_archive_title( '<h2 class="page-title">', '</h2>' );
                              the_archive_description( '<div class="taxonomy-description">', '</div>' );

                          } elseif( is_search() ) { ?>

                              <h2 class="page-title">
                                    <?php printf( esc_html__( 'Search Results for: %s', 'craft-blog' ), '<span>' . get_search_query() . '</span>' ); ?>
                              </h2>

                          <?php } elseif( is_404() ) {

                              echo '<h2 class="entry-title">'. esc_html( '404 Error', 'craft-blog' ) .'</h2>';

                          } elseif( is_home() ) {

                              $page_for_posts_id = get_option( 'page_for_posts' );
                              $page_title = get_the_title( $page_for_posts_id );

                          ?>

                              <h2 class="entry-title"><?php echo esc_html( $page_title ); ?></h2>

                        <?php } ?>

                        <nav id="breadcrumb" class="craft-blog-breadcrumb">
                            <?php
                                breadcrumb_trail( array(
                                  'container'   => 'div',
                                  'show_browse' => false,
                                ) );
                            ?>
                        </nav>
                  </div>
              </div>
          </div>
      </div>

    <?php }

endif;

add_action( 'craft_blog_breadcrumb_header', 'craft_blog_breadcrumb_header_title', 10 );

/**
 * Define font awesome social media icons
 *
 * @return array();
 * @since 1.0.0
 */
if( ! function_exists( 'craft_blog_font_awesome_social_icon_array' ) ) :
    function craft_blog_font_awesome_social_icon_array(){
        return array(
                "fa fa-facebook","fa fa-twitter","fa fa-yahoo",	"fa fa-google-wallet","fa fa-instagram","fa fa-linkedin","fa fa-pinterest-p","fa fa-pinterest","fa fa-google-plus","fa fa-youtube","fa fa-vimeo",
            );
    }
endif;


if( class_exists( 'WP_Customize_control' ) ) { 

	 /**
     * Switch Controller ( Enable or Disable )
     *
     * @since 1.0.0
    */

    class Craft_Blog_Switch_Control extends WP_Customize_Control{

        public $type = 'switch';

        public $on_off_label = array();

        public function __construct($manager, $id, $args = array() ){
            $this->on_off_label = $args['on_off_label'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content(){
        ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                	<?php echo wp_kses_post( $this->description ); ?>
                </span>
            <?php } ?>

            <?php
                $switch_class = ($this->value() == 'on') ? 'switch-on' : '';
                $on_off_label = $this->on_off_label;
            ?>
            <div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
                <div class="onoffswitch-inner">
                    <div class="onoffswitch-active">
                        <div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
                    </div>

                    <div class="onoffswitch-inactive">
                        <div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
                    </div>
                </div>  
            </div>
            <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
            <?php
        }
    }

    /**
     * Page/Post Layout Controller
     *
     * @since 1.0.0
    */
    class Craft_Blog_Customize_Control_Radio_Image extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'radio-image';

        /**
         * Loads the jQuery UI Button script and custom scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();

            // We need to make sure we have the correct image URL.
            foreach ( $this->choices as $value => $args )
                $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
        }


        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */

        public function content_template() { ?>
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
            <# } #>

            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <div class="buttonset">

                <# for ( key in data.choices ) { #>

                    <input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> /> 

                    <label for="{{ data.id }}-{{ key }}">
                        <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
                        <img src="{{ data.choices[ key ]['url'] }}" title="{{ data.choices[ key ]['label'] }}" alt="{{ data.choices[ key ]['label'] }}" />
                    </label>
                <# } #>

            </div><!-- .buttonset -->
        <?php }
    }

    /**
     * Customize controls for repeater field
     *
     * @since 1.0.0
     */
    class Craft_Blog_Repeater_Controler extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';

        public $craft_blog_box_label = '';

        public $craft_blog_box_add_control = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.0
         */
        public function __construct( $manager, $id, $args = array(), $fields = array() ) {
            $this->fields = $fields;
            $this->craft_blog_box_label = $args['craft_blog_box_label'] ;
            $this->craft_blog_box_add_control = $args['craft_blog_box_add_control'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {

            $values = json_decode( $this->value() );
        ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php if( $this->description ){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post( $this->description ); ?>
                </span>
            <?php } ?>

            <ul class="craft-blog-repeater-field-control-wrap">
                <?php $this->craft_blog_get_fields(); ?>
            </ul>

            <input type="hidden" <?php esc_attr( $this->link() ); ?> class="craft-blog-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
            <button type="button" class="button craft-blog-repeater-add-control-field"><?php echo esc_html( $this->craft_blog_box_add_control ); ?></button>
        <?php }

        private function craft_blog_get_fields(){
            $fields = $this->fields;
            $values = json_decode( $this->value() );

            if( is_array( $values ) ){
            foreach( $values as $value ){
        ?>
            <li class="craft-blog-repeater-field-control">
              <h3 class="craft-blog-repeater-field-title"><?php echo esc_html( $this->craft_blog_box_label ); ?></h3>
            
              <div class="craft-blog-repeater-fields">
                <?php
                    foreach ( $fields as $key => $field ) {
                    $class = isset( $field['class'] ) ? $field['class'] : '';
                ?>
                    <div class="craft-blog-repeater-field craft-blog-repeater-type-<?php echo esc_attr( $field['type'] ).' '. esc_attr( $class ); ?>">

                      <?php 
                          $label = isset( $field['label'] ) ? $field['label'] : '';
                          $description = isset( $field['description'] ) ? $field['description'] : '';
                          if( $field['type'] != 'checkbox' ) { 
                      ?>
                              <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                              <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                      <?php }

                          $new_value = isset( $value->$key ) ? $value->$key : '';
                          $default = isset( $field['default'] ) ? $field['default'] : '';

                          switch ( $field['type'] ) {

                              case 'text':
                                  echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_attr( $new_value ).'"/>';
                                  break;

                              case 'url':
                                  echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_url( $new_value ).'"/>';
                                  break;

                              case 'social_icon':
                                  echo '<div class="craft-blog-repeater-selected-icon">';
                                    echo '<i class="'.esc_attr( $new_value ).'"></i>';
                                    echo '<span><i class="fa fa-angle-down"></i></span>';
                                  echo '</div>';
                                  echo '<ul class="craft-blog-repeater-icon-list craft-blog-clearfix">';
                                    $craft_blog_font_awesome_social_icon_array = craft_blog_font_awesome_social_icon_array();
                                    foreach ( $craft_blog_font_awesome_social_icon_array as $craft_blog_font_awesome_icon ) {
                                        $icon_class = $new_value == $craft_blog_font_awesome_icon ? 'icon-active' : '';
                                        echo '<li class='. esc_attr( $icon_class ) .'><i class="'. esc_attr( $craft_blog_font_awesome_icon ) .'"></i></li>';
                                    }
                                  echo '</ul>';
                                  echo '<input data-default="'.esc_attr( $default ).'" type="hidden" value="'.esc_attr( $new_value ).'" data-name="'.esc_attr($key).'"/>';
                                  break;

                              default:
                                  break;
                          }
                      ?>
                    </div>

                <?php } ?>

                  <div class="craft-blog-clearfix craft-blog-repeater-footer">
                      <div class="alignright">
                      <a class="craft-blog-repeater-field-remove" href="#remove"><?php esc_html_e( 'Delete', 'craft-blog' ) ?></a> |
                      <a class="craft-blog-repeater-field-close" href="#close"><?php esc_html_e( 'Close', 'craft-blog' ) ?></a>
                      </div>
                  </div>
              </div>

            </li>
            <?php }
            }
        }
    }

    /**
     * Multiple Category Select Custom Control Function
     *
     * @since 1.0.0
     */
    class Craft_Blopg_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

       /**
        * The type of customize control being rendered.
        *
        * @since  1.0.0
        * @access public
        * @var    string
        */
       public $type = 'checkbox-multiple';

       /**
        * Displays the control content.
        *
        * @since  1.0.0
        * @access public
        * @return void
        */
       public function render_content() {

           if ( empty( $this->choices ) )
               return; ?>
             
           <?php if ( !empty( $this->label ) ) : ?>
               <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
           <?php endif; ?>

           <?php if ( !empty( $this->description ) ) : ?>
               <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
           <?php endif; ?>

           <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>
           <ul>
               <?php foreach ( $this->choices as $value => $label ) : ?>
                   <li>
                       <label>
                           <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                           <?php echo esc_html( $label ); ?>
                       </label>
                   </li>
               <?php endforeach; ?>
           </ul>
           <input type="hidden" <?php esc_url( $this->link() ); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
       <?php }
    }

    /**
     * Pro Version
     *
     * @since 1.0.1
    */
    class Craft_Blog_Customize_Pro_Version extends WP_Customize_Control {

        public $type = 'pro_options';

        public function render_content() {
            echo '<span>'.esc_html_e('Want more ','craft-blog').'<strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url( $this->description ) .'" target="_blank">';
              echo '<span class="dashicons dashicons-info"></span>';
              echo '<strong> '. esc_html__( 'See Craft Blog PRO', 'craft-blog' ) .'<strong></a>';
            echo '</a>';
        }
    }

}