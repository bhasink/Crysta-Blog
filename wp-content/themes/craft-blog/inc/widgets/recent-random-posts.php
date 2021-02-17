<?php
/**
 * Craft Blog: Recent & Random Posts Block
 *
 * Widget show the Recent & Random posts all posts.
 *
 * @package Sparkle Themes
 * @subpackage Craft Blog
 * @since 1.0.0
 */

class Craft_Blog_Recent_Random_Block_Posts extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'craftblog_recent_block clearfix',
            'description' => esc_html__( 'Displays recent and random posts from all list posts.', 'craft-blog' )
        );

        parent::__construct( 'craftblog_recent_block', esc_html__( 'Craft Blog: Recent & Random Posts', 'craft-blog' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'block_title' => array(
                'craftblog_widgets_name'         => 'block_title',
                'craftblog_widgets_title'        => esc_html__( 'Block Layout Title', 'craft-blog' ),
                'craftblog_widgets_description'  => esc_html__( 'Enter your block title. (Optional - Leave blank to hide the title.)', 'craft-blog' ),
                'craftblog_widgets_field_type'   => 'text'
            ),

            'block_posts_count' => array(
                'craftblog_widgets_name'         => 'block_posts_count',
                'craftblog_widgets_title'        => esc_html__( 'Number of Posts', 'craft-blog' ),
                'craftblog_widgets_default'      => '5',
                'craftblog_widgets_field_type'   => 'number'
            ),

            'block_posts_type' => array(
                'craftblog_widgets_name'          => 'block_posts_type',
                'craftblog_widgets_title'         => esc_html__('Choose Posts Options', 'craft-blog'),
                'craftblog_widgets_default'      => 'desc',
                'craftblog_widgets_field_type'   => 'select',
                'craftblog_widgets_field_options' => array('desc' => 'Latest Posts', 'rand' => 'Random Posts')
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

        $craftblog_block_title    = apply_filters( 'widget_title', !empty( $instance['block_title'] ) ? $instance['block_title'] : '', $instance, $this->id_base );
        $craftblog_posts_count    = empty( $instance['block_posts_count'] ) ? 5 : $instance['block_posts_count'];
        $craftblog_posts_type     = empty( $instance['block_posts_type'] ) ? 'desc' : $instance['block_posts_type'];

        $craftblog_block_args = array(
            'orderby'        => $craftblog_posts_type,
            'posts_per_page' => absint( $craftblog_posts_count )
        );

        $craftblog_block_query = new WP_Query( $craftblog_block_args );

        echo $before_widget;

        if ( ! empty( $craftblog_block_title ) ) {
            echo $args['before_title'] . esc_html( $craftblog_block_title ) . $args['after_title'];
        }

        if( $craftblog_block_query->have_posts() ) {

        echo '<div class="craftblog_relatedpost_widget">';

        while( $craftblog_block_query->have_posts() ) { $craftblog_block_query->the_post();

    ?>
        
        <div class="boxes_holder craftblog-clearfix">
            <div class="left_box">
                <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                    <?php
                        the_post_thumbnail('craft-blog-list-post');
                    ?>
                </a>
            </div>

            <div class="right_box">

                <div class="post_title">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </div>

                <div class="entry-meta info">
                    <?php
                        craft_blog_posted_on();
                        craft_blog_posted_by();
                        craft_blog_comments();
                    ?>
                </div><!-- .entry-meta -->

            </div>
        </div>

    <?php }

        echo '</div>';

    } wp_reset_postdata();

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