<?php
/**
 * Craft Blog: Popular / Tags / Comments
 *
 * Widget display popular, recent, comment
 *
 * @package Sparkle Themes
 * @subpackage Craft Blog
 * @since 1.0.0
 */

class Craft_Blog_Tabbed_Block_Posts extends WP_widget {

    /**
     * Register widget with WordPress.wp_trim_words
     */
    public function __construct() {

        $widget_ops = array( 
            'classname' => 'craftblog_tabbed_block craftblog-clearfix',
            'description' => esc_html__( 'Widget display popular, recent, comment', 'craft-blog' )
        );

        parent::__construct( 'craftblog_tabbed_block', esc_html__( 'Craft Blog: Popular / Tags / Comments', 'craft-blog' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'block_popular_disable' => array(
                'craftblog_widgets_name' => 'block_popular_disable',
                'craftblog_widgets_title' => esc_html__('Checked To Disable Polular Posts', 'craft-blog'),
                'craftblog_widgets_field_type' => 'checkbox',
            ),

            'block_popular_title' => array(
                'craftblog_widgets_name' => 'block_popular_title',
                'craftblog_widgets_title' => esc_html__('Popular Posts Title', 'craft-blog'),
                'craftblog_widgets_field_type' => 'text',
            ),       

            'block_comments_disable' => array(
                'craftblog_widgets_name' => 'block_comments_disable',
                'craftblog_widgets_title' => esc_html__('Checked To Disable Comments', 'craft-blog'),
                'craftblog_widgets_field_type' => 'checkbox',
            ),

            'block_comments_title' => array(
                'craftblog_widgets_name' => 'block_comments_title',
                'craftblog_widgets_title' => esc_html__('Comments Title', 'craft-blog'),
                'craftblog_widgets_field_type' => 'text',
            ),

            'block_tag_disable' => array(
                'craftblog_widgets_name' => 'block_tag_disable',
                'craftblog_widgets_title' => esc_html__('Checked To Disable Tags', 'craft-blog'),
                'craftblog_widgets_field_type' => 'checkbox',
            ),

            'block_tag_title' => array(
                'craftblog_widgets_name' => 'block_tag_title',
                'craftblog_widgets_title' => esc_html__('Tags Title', 'craft-blog'),
                'craftblog_widgets_field_type' => 'text',
            ),   
           
            'block_posts_count' => array(
                'craftblog_widgets_name' => 'block_posts_count',
                'craftblog_widgets_title'        => esc_html__('Enter Display Number of Posts', 'craft-blog'),
                'craftblog_widgets_default'      => '5',
                'craftblog_widgets_field_type'   => 'number',
            ),

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

        $popular      = empty( $instance['block_popular_disable'] ) ? '' : $instance['block_popular_disable'];
        $populartitle = apply_filters( 'widget_title', empty($instance['block_popular_title']) ? '' : $instance['block_popular_title'], $instance, $this->id_base);

        $comment      = empty( $instance['block_comments_disable'] ) ? '' : $instance['block_comments_disable'];
        $commenttitle = apply_filters( 'widget_title', empty($instance['block_comments_title']) ? '' : $instance['block_comments_title'], $instance, $this->id_base);

        $tag          = empty( $instance['block_tag_disable'] ) ? '' : $instance['block_tag_disable'];
        $tagtitle     = apply_filters( 'widget_title', empty($instance['block_tag_title']) ? '' : $instance['block_tag_title'], $instance, $this->id_base);

        $nposts  = empty( $instance['block_posts_count'] ) ? 5 : $instance['block_posts_count'];


        echo $before_widget;
    ?>
        
        <div class="craftblog-tabs-wdt">

            <ul class="craftblog-tab-nav">
                <?php if($popular != 1){ ?>
                    <li class="craftblog-tab">
                        <a class="craftblog-tab-anchor" href="#craftblog-popular">
                            <?php echo esc_html( $populartitle ); ?>
                        </a>
                    </li>
                <?php } if($comment != 1){ ?>
                    <li class="craftblog-tab">
                        <a class="craftblog-tab-anchor" href="#craftblog-comments">
                            <?php echo esc_html( $commenttitle ); ?>
                        </a>
                    </li>
                <?php } if($tag != 1){ ?>
                    <li class="craftblog-tab">
                        <a class="craftblog-tab-anchor" href="#craftblog-tags">
                            <?php echo esc_html( $tagtitle ); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <?php if($popular != 1){ ?>
                    <div id="craftblog-popular" class="craftblog_relatedpost_widget">
                        <?php 
                            $args = array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $nposts, 'post_status' => 'publish', 'orderby' => 'comment_count', 'order' => 'desc' );
                            $popular = new WP_Query( $args );

                            if ( $popular->have_posts() ) : while( $popular-> have_posts() ) : $popular->the_post(); ?>
                                
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

                            <?php endwhile; endif; wp_reset_postdata(); ?>
                    </div><!-- .tab-pane #craftblog-popular -->

                <?php } if($comment != 1){ ?>

                    <div id="craftblog-comments">
                        <?php

                            $avatar_size = 50;
                            $args = array(
                                'number'       => $nposts,
                            );
                            $comments_query = new WP_Comment_Query;
                            $comments = $comments_query->query( $args );    
                        
                            if ( $comments ) {
                                foreach ( $comments as $comment ) { ?>
                                    <div class="craftblog-comment">
                                        <figure class="craftblog_avatar">
                                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                                <?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?>     
                                            </a>                               
                                        </figure> 
                                        <div class="craftblog-comm-content">
                                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                                <span class="craftblog-comment-author"><?php echo esc_html( get_comment_author( $comment->comment_ID ) ); ?> </span> - <span class="craftblog_comment_post">
                                                    <?php echo esc_html( get_the_title( $comment->comment_post_ID ) ); ?>                                                
                                                </span>
                                            </a>
                                            <?php echo '<p class="craftblog-comment">' . comment_excerpt( $comment->comment_ID ). '</p>'; ?>
                                        </div>
                                    </div>
                                <?php }
                            } else {
                                esc_html_e( 'No comments found.', 'craft-blog' );
                            }
                        ?>
                    </div><!-- .tab-pane #craftblog-comments -->
                <?php } if($tag != 1){ ?>

                    <div id="craftblog-tags">
                        <?php        
                            $tags = get_tags();             
                            if($tags) {               
                                foreach ( $tags as $tag ): ?>    
                                    <a href="<?php echo esc_url( get_term_link( $tag ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>          
                                    <?php     
                                endforeach;       
                            } else {          
                                esc_html_e( 'No tags created.', 'craft-blog');           
                            }            
                        ?>
                    </div><!-- .tab-pane #craftblog-tags-->
                <?php } ?>
            </div><!-- .tab-content -->     

        </div><!-- #tabs -->


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