<?php
/**
 * Define custom fields for widgets
 * 
 * @package Sparkle Themes
 * @subpackage Craft Blog Pro
 * @since 1.0.0
 */

function craftblog_widgets_show_widget_field( $instance = '', $widget_field = '', $craftblog_widget_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $craftblog_widgets_field_type ) {

        /**
         * Text field
         */
        case 'text' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>"><?php echo esc_attr( $craftblog_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $craftblog_widgets_name ) ); ?>" type="text" value="<?php echo esc_attr( $craftblog_widget_field_value ); ?>" />

                <?php if ( isset( $craftblog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $craftblog_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * URL field
         */
        case 'url' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>"><?php echo esc_html( $craftblog_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $craftblog_widgets_name ) ); ?>" type="text" value="<?php echo esc_url( $craftblog_widget_field_value ); ?>" />

                <?php if ( isset( $craftblog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $craftblog_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * Number field
         */
        case 'number' :
            if( empty( $craftblog_widget_field_value ) ) {
                $craftblog_widget_field_value = $craftblog_widgets_default;
            }
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>"><?php echo esc_html( $craftblog_widgets_title ); ?></label></span>
                <input name="<?php echo esc_attr( $instance->get_field_name( $craftblog_widgets_name ) ); ?>" type="number" step="1" min="1" id="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>" value="<?php echo esc_attr( $craftblog_widget_field_value ); ?>" class="widefat" />

                <?php if ( isset( $craftblog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $craftblog_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;


        /**
         * Checkbox field
         */
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $craftblog_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked( '1', $craftblog_widget_field_value ); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>"><?php echo esc_html( $craftblog_widgets_title ); ?></label>

                <?php if ( isset( $craftblog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $craftblog_widgets_description ); ?></em>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Textarea field
         */
        case 'textarea' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>"><?php echo esc_html( $craftblog_widgets_title ); ?></label></span>
                <textarea class="widefat" rows="<?php echo absint( $craftblog_widgets_row ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $craftblog_widgets_name ) ); ?>"><?php echo esc_textarea( $craftblog_widget_field_value ); ?></textarea>
            </p>
        <?php
            break;


        /**
         * Select field
         */
        case 'select' :
            if( empty( $craftblog_widget_field_value ) ) {
                $craftblog_widget_field_value = $craftblog_widgets_default;
            }

        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>"><?php echo esc_html( $craftblog_widgets_title ); ?></label></span> 
                <select name="<?php echo esc_attr( $instance->get_field_name( $craftblog_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $craftblog_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo esc_attr( $athm_option_name ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" <?php selected( $athm_option_name, $craftblog_widget_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $craftblog_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $craftblog_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;
            
       
        /**
         * Upload field
         */
        case 'upload':
            $image = $image_class = "";
            if( $craftblog_widget_field_value ){ 
                $image = '<img src="'.esc_url( $craftblog_widget_field_value ).'" style="max-width:100%;"/>';    
                $image_class = ' hidden';
            }
        ?>
            <div class="attachment-media-view">

            <p><span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>"><?php echo esc_html( $craftblog_widgets_title ); ?>:</label></span></p>
            
                <div class="placeholder<?php echo esc_attr( $image_class ); ?>">
                    <?php esc_html_e( 'No image selected', 'craft-blog' ); ?>
                </div>
                <div class="thumbnail thumbnail-image">
                    <?php echo wp_kses_post ( $image ); ?>
                </div>

                <div class="actions craftblog-clearfix">
                    <button type="button" class="button craftblog-delete-button align-left"><?php esc_html_e( 'Remove', 'craft-blog' ); ?></button>
                    <button type="button" class="button craftblog-upload-button alignright"><?php esc_html_e( 'Select Image', 'craft-blog' ); ?></button>
                    
                    <input name="<?php echo esc_attr( $instance->get_field_name( $craftblog_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $craftblog_widgets_name ) ); ?>" class="upload-id" type="hidden" value="<?php echo esc_url( $craftblog_widget_field_value ) ?>"/>
                </div>

            <?php if ( isset( $craftblog_widgets_description ) ) { ?>
                <br />
                <em><?php echo wp_kses_post( $craftblog_widgets_description ); ?></em>
            <?php } ?>

            </div><!-- .attachment-media-view -->
        <?php
            break;
    }
}

function craftblog_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    if ( $craftblog_widgets_field_type == 'number') {
        return absint( $new_field_value );
    } elseif ( $craftblog_widgets_field_type == 'textarea' ) {
        return sanitize_textarea_field( $new_field_value );
    } elseif ( $craftblog_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } else {
        return strip_tags( $new_field_value );
    }
}