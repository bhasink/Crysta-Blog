<?php
/**
 * Custom customizer control class for multiple select dropdown taxonomies.
 *
 * @package    Cream_Blog
 * @author     Themebeez <themebeez@gmail.com>
 * @copyright  Copyright (c) 2018, Themebeez
 * @link       http://themebeez.com/themes/cream-blog/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if( class_exists( 'WP_Customize_Control' ) ) {
  /**
   * Class Cream_Blog_Multiple_Select_Dropdown_Taxonomies
   */
  class Cream_Blog_Multiple_Select_Dropdown_Taxonomies extends WP_Customize_Control {
    public $type = 'multiple-select-dropdown-taxonomies';
    public $placeholder = '';

    public function __construct($manager, $id, $args = array()) {
      parent::__construct( $manager, $id, $args );
    }

    public function render_content() {
      if ( empty( $this->choices ) ) {
        return;
      }       
      ?>
        <label>
          <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
          </span>
          <?php if($this->description) { ?>
            <span class="description customize-control-description">
            <?php echo wp_kses_post($this->description); ?>
            </span>
          <?php } ?>
          <select multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
            <?php
            foreach ( $this->choices as $value => $label ) {
              $selected = '';
              if(in_array($value, $this->value())){
                  $selected = 'selected="selected"';
              }
              echo '<option value="' . esc_attr( $value ) . '"' . esc_attr( $selected ) . '>' . esc_html($label) . '</option>';
            }
            ?>
          </select>
        </label>
      <?php
    }
  }
}