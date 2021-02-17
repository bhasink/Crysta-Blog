<?php
/**
 * Craft Blog: About Us
 *
 * Widget show the personal information with social media icons.
 *
 * @package Sparkle Themes
 * @subpackage Craft Blog
 * @since 1.0.0
 */

class Craft_Blog_About_Us extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'craftblog_aboutus',
            'description' => esc_html__( 'A widget shows personal information with social media icons.', 'craft-blog' )
        );
        parent::__construct( 'craftblog_aboutus', esc_html__( 'Craft Blog: About Us', 'craft-blog' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'block_title' => array(
                'craftblog_widgets_name'         => 'block_title',
                'craftblog_widgets_title'        => esc_html__( 'Block Title', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'text'
            ),

            'block_image' => array(
                'craftblog_widgets_name'         => 'block_image',
                'craftblog_widgets_title'        => esc_html__( 'Upload About Us Image', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'upload'
            ),

            'block_aboutus_title' => array(
                'craftblog_widgets_name'         => 'block_aboutus_title',
                'craftblog_widgets_title'        => esc_html__( 'About Us Title', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'text'
            ),

            'block_textarea' => array(
                'craftblog_widgets_name'         => 'block_textarea',
                'craftblog_widgets_title'        => esc_html__( 'About Us Short Text', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'textarea',
                'craftblog_widgets_row'          => 4
            ),

            'block_fb_url' => array(
                'craftblog_widgets_name'         => 'block_fb_url',
                'craftblog_widgets_title'        => esc_html__( 'Facebook URL', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'url'
            ),

            'block_tw_url' => array(
                'craftblog_widgets_name'         => 'block_tw_url',
                'craftblog_widgets_title'        => esc_html__( 'Twitter URL', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'url'
            ),

            'block_linkedin_url' => array(
                'craftblog_widgets_name'         => 'block_linkedin_url',
                'craftblog_widgets_title'        => esc_html__( 'Linkedin URL', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'url'
            ),

            'block_youtube_url' => array(
                'craftblog_widgets_name'         => 'block_youtube_url',
                'craftblog_widgets_title'        => esc_html__( 'Youtube URL', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'url'
            ),

            'block_instagram_url' => array(
                'craftblog_widgets_name'         => 'block_instagram_url',
                'craftblog_widgets_title'        => esc_html__( 'Instagram URL', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'url'
            ),

            'block_gp_url' => array(
                'craftblog_widgets_name'         => 'block_gp_url',
                'craftblog_widgets_title'        => esc_html__( 'Google Plus URL', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'url'
            )
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        extract( $args );

        if( empty( $instance ) ) {
            return ;
        }

        $craftblog_block_title  = apply_filters( 'widget_title', !empty( $instance['block_title'] ) ? $instance['block_title'] : '', $instance, $this->id_base );
        
        $craftblog_aboutus_title = empty( $instance['block_aboutus_title'] ) ? '' : $instance['block_aboutus_title'];
        $craftblog_block_image = empty( $instance['block_image'] ) ? '' : $instance['block_image'];
        $craftblog_block_text  = empty( $instance['block_textarea'] ) ? '' : $instance['block_textarea'];
        $craftblog_block_fb    = empty( $instance['block_fb_url'] ) ? '' : $instance['block_fb_url'];
        $craftblog_block_tw    = empty( $instance['block_tw_url'] ) ? '' : $instance['block_tw_url'];
        $craftblog_block_ins   = empty( $instance['block_instagram_url'] ) ? '' : $instance['block_instagram_url'];
        $craftblog_block_lin   = empty( $instance['block_linkedin_url'] ) ? '' : $instance['block_linkedin_url'];
        $craftblog_block_gp    = empty( $instance['block_gp_url'] ) ? '' : $instance['block_gp_url'];
        $craftblog_block_yut   = empty( $instance['block_youtube_url'] ) ? '' : $instance['block_youtube_url'];


        echo $before_widget;
    ?>

        <div class="craftblog-aboutus-wrap">
            <?php
                if ( ! empty( $craftblog_block_title ) ) {

                    echo $args['before_title'] . esc_html( $craftblog_block_title ) . $args['after_title'];

                }
            ?>
            <div class="author_widget">
                <?php if( !empty( $craftblog_block_image ) ){ ?>
                    <div class="author_thumb">
                        <img src="<?php echo esc_url( $craftblog_block_image ); ?>" alt="<?php echo esc_attr( $craftblog_aboutus_title ); ?>">
                    </div>
                <?php } if( !empty( $craftblog_aboutus_title ) ){ ?>
                    <div class="author_name">
                        <h4><?php echo esc_attr( $craftblog_aboutus_title ); ?></h4>
                    </div>
                <?php } if( !empty( $craftblog_block_text ) ){ ?>
                    <div class="author_desc">
                        <p><?php echo esc_attr( $craftblog_block_text ); ?></p>
                    </div>
                <?php } ?>
            </div>

            <div class="sociallink">
                <?php
                    if( !empty( $craftblog_block_fb ) || !empty( $craftblog_block_tw ) ){
                        echo '<ul>';
                                    if( !empty( $craftblog_block_fb ) ){ echo '<li><a href="'. esc_url( $craftblog_block_fb ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-facebook' ) .'"></i></a></li>'; }
                                    if( !empty( $craftblog_block_tw ) ){ echo '<li><a href="'. esc_url( $craftblog_block_tw ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-twitter' ) .'"></i></a></li>'; }
                                    if( !empty( $craftblog_block_lin ) ){ echo '<li><a href="'. esc_url( $craftblog_block_lin ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-linkedin' ) .'"></i></a></li>'; }
                                    if( !empty( $craftblog_block_yut ) ){ echo '<li><a href="'. esc_url( $craftblog_block_yut ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-youtube' ) .'"></i></a></li>'; }
                                    if( !empty( $craftblog_block_ins ) ){ echo '<li><a href="'. esc_url( $craftblog_block_ins ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-instagram' ) .'"></i></a></li>'; }
                                    if( !empty( $craftblog_block_gp ) ){ echo '<li><a href="'. esc_url( $craftblog_block_gp ) .'" target="_blank"><i class="'. esc_attr( 'fa fa-google-plus' ) .'"></i></a></li>'; }
                        echo '</ul>';
                    }
                ?>
            </div>
        </div>
            
    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    craftblog_widgets_updated_field_value()     defined in craftblog-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$craftblog_widgets_name] = craftblog_widgets_updated_field_value( $widget_field, $new_instance[$craftblog_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    craftblog_widgets_show_widget_field()       defined in craftblog-widget-fields.php
     */
    public function form( $instance ) {

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );

            $craftblog_widgets_field_value = !empty( $instance[$craftblog_widgets_name] ) ? wp_kses_post( $instance[$craftblog_widgets_name] ) : '';

            craftblog_widgets_show_widget_field( $this, $widget_field, $craftblog_widgets_field_value );
        }
    }
}