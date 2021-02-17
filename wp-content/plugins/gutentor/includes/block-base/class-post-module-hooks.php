<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_Post_Module_Hooks' ) ) {

	/**
	 * Block Specific Hooks Class For Gutentor
	 * @package Gutentor
	 * @since 2.0.0
	 *
	 */
	class Gutentor_Post_Module_Hooks{

		/**
		 * Prevent some functions to called many times
		 * @access private
		 * @since 2.0.0
		 * @var integer
		 */
		private static $counter = 0;

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 2.0.0
		 * @return object
		 */
		public static function get_instance() {

			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance
			return $instance;

		}
		
        /**
         * Add Filter
         *
         * @access public
         * @since 2.0.0
         * @return void
         */
		public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ){
            add_filter( $hook, array( $component, $callback ), $priority, $accepted_args );
        }

        /**
         * Add Action
         *
         * @access public
         * @since 2.0.0
         * @return void
         */
        public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ){
            add_action( $hook, array( $component, $callback ), $priority, $accepted_args );
        }

		/**
		 * Add Shape Array
		 *
		 * @access public
		 * @since 2.0.0
		 * @return array
		 */
		public function blockShapeDividerSvgArray() {

			$shape = array(
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"><path d="M0,6V0H1000V100Z" transform="translate(0 0)"></path></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"><path d="M0,22.3V0H1000V100Z" transform="translate(0 0)" style="opacity:0.66"></path><path d="M0,6V0H1000V100Z" transform="translate(0 0)"></path></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 84.94" preserveAspectRatio="none"><path d="M0,0V72.94c14.46,5.89,32.38,10.5,54.52.26,110.25-51,120.51,23.71,192.6-4.3,144.73-56.23,154.37,49.44,246.71,4.64C637,4.05,622.19,124.16,757.29,66.21c93-39.91,108.38,54.92,242.71-8.25V0Z" style="fill-rule:evenodd;opacity:0.33"></path><path d="M0,0V52.83c131.11,59.9,147-32.91,239.24,6.65,135.09,58,120.24-62.16,263.46,7.34,92.33,44.8,102-60.88,246.71-4.64,72.1,28,82.35-46.71,192.6,4.3,23.95,11.08,43,4.78,58-1.72V0Z" style="fill-rule:evenodd;opacity:0.66"></path><path d="M0,0V24.26c15.6,6.95,35.77,15.41,61.78,3.38,110.25-51,120.51,23.71,192.6-4.3C399.11-32.89,408.75,72.79,501.08,28,644.3-41.51,629.45,78.6,764.54,20.65,855.87-18.53,872.34,72.12,1000,15.7V0Z" style="fill-rule:evenodd"></path></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 99" preserveAspectRatio="none"><path d="M526.35,17.11C607.41,28.38,687,48.17,768.06,59.5A1149.19,1149.19,0,0,0,1000,68.07V0H0V99C155.18,13.84,347.42-7.77,526.35,17.11Z" transform="translate(0 0.04)"></path></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"><path class="st0" d="M499.9,51"></path><path class="st1" d="M0,1v94.2c256.7-171,917.3-15.6,1000,4.8V1H0z"></path><path d="M0,100h1.3C273.1-106.1,1000,77.4,1000,77.4V0H0V100z"></path></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"><polygon points="0,0 0,46.7 40.7,23.4 82.5,47.2 124.2,23.4 166,47.2 207.7,23.4 249.4,47.2 291.2,23.4 332.9,47.2 374.7,23.4 416.4,47.2 458.1,23.4 499.9,47.2 541.6,23.4 583.4,47.2 625.1,23.4 666.9,47.2 708.6,23.4 750.3,47.2 792.1,23.4 833.8,47.2 875.6,23.4 917.3,47.2 959,23.4 1000,46.8 1000,0 "></polygon><path class="st0" d="M499.9,51"></path></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 435" preserveAspectRatio="none"><path class="path1" d="M1920,435.1H0V49c32.8,32,92.7,82.1,180,108.3C486.8,249.6,554.4-28.5,918,9.1C1152.9,33.4,1328.5,180,1602,176 c137.7-2,248.9-43,318-75C1920,229.7,1920,306.4,1920,435.1z" style="fill-rule:evenodd;opacity:0.33; transform: rotate(180deg); transform-origin:50% 50%;" ></path><path class="path2" d="M1920,288.1c-228,42-357.8,100.5-489,54c-254.1-90-325.1-324.6-603-315C619.8,34.3,532.8,150,280.5,228.8    c-136.7,42.7-178-42.7-280.5-48.6v255h1920V288.1z" style="fill-rule:evenodd;opacity:0.66; transform: rotate(180deg); transform-origin:50% 50%;"></path><path class="path3" d="M1920,435.1H0v-215c81,5,135,77,243,41c199.3-66.4,294.5-143.1,405-162c315-54,384.2,131.1,585,207 c165,62.4,385,129,687-120C1920,236.1,1920,385.1,1920,435.1z" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"></path></svg>',
			'<svg width="100%" viewBox="0 0 1280 86" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><g><path d="M1280 66.1c-3.8 0-7.6.3-11.4.8-18.3-32.6-59.6-44.2-92.2-25.9-3.5 2-6.9 4.3-10 6.9-22.7-41.7-74.9-57.2-116.6-34.5-14.2 7.7-25.9 19.3-33.8 33.3-.2.3-.3.6-.5.8-12.2-1.4-23.7 5.9-27.7 17.5-11.9-6.1-25.9-6.3-37.9-.6-21.7-30.4-64-37.5-94.4-15.7-12.1 8.6-21 21-25.4 35.2-10.8-9.3-24.3-15-38.5-16.2-8.1-24.6-34.6-38-59.2-29.9-14.3 4.7-25.5 16-30 30.3-4.3-1.9-8.9-3.2-13.6-3.8-13.6-45.5-61.5-71.4-107-57.8a86.38 86.38 0 0 0-43.2 29.4c-8.7-3.6-18.7-1.8-25.4 4.8-23.1-24.8-61.9-26.2-86.7-3.1-7.1 6.6-12.5 14.8-15.9 24-26.7-10.1-56.9-.4-72.8 23.3-2.6-2.7-5.6-5.1-8.9-6.9-.4-.2-.8-.4-1.2-.7-.6-25.9-22-46.4-47.9-45.8-11.5.3-22.5 4.7-30.9 12.5-16.5-33.5-57.1-47.3-90.6-30.8-21.9 11-36.3 32.7-37.6 57.1-7-2.3-14.5-2.8-21.8-1.6C84.8 47 55.7 40.7 34 54.8c-5.6 3.6-10.3 8.4-13.9 14-6.6-1.7-13.3-2.6-20.1-2.6-.1 0 0 19.8 0 19.8h1280V66.1z" fill-opacity=".5" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/><path d="M15.6 86H1280V48.5c-3.6 1.1-7.1 2.5-10.4 4.4-6.3 3.6-11.8 8.5-16 14.5-8.1-1.5-16.4-.9-24.2 1.7-3.2-39-37.3-68.1-76.4-64.9-24.8 2-46.8 16.9-57.9 39.3-19.9-18.5-51-17.3-69.4 2.6-8.2 8.8-12.8 20.3-13.1 32.3-.4.2-.9.4-1.3.7-3.5 1.9-6.6 4.4-9.4 7.2-16.6-24.9-48.2-35-76.2-24.4-12.2-33.4-49.1-50.6-82.5-38.4-9.5 3.5-18.1 9.1-25 16.5-7.1-6.9-17.5-8.8-26.6-5-30.4-39.3-87-46.3-126.2-15.8-14.8 11.5-25.6 27.4-31 45.4-4.9.6-9.7 1.9-14.2 3.9-8.2-25.9-35.8-40.2-61.7-32-15 4.8-26.9 16.5-31.8 31.5-14.9 1.3-29 7.2-40.3 17-11.5-37.4-51.2-58.4-88.7-46.8-14.8 4.6-27.7 13.9-36.7 26.5-12.6-6-27.3-5.7-39.7.6-4.1-12.2-16.2-19.8-29-18.4-.2-.3-.3-.6-.5-.9-24.4-43.3-79.4-58.6-122.7-34.2-13.3 7.5-24.4 18.2-32.4 31.2C99.8 18.5 50 28.5 25.4 65.4c-4.3 6.4-7.5 13.3-9.8 20.6z" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/></g></svg>',
			'<svg width="100%" height="300px" viewBox="0 0 1280 140" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><g><path d="M853.893,86.998c-38.859,0-58.811-16.455-77.956-35.051c18.295-10.536,40.891-18.276,73.378-18.276 c38.685,0,64.132,12.564,85.489,28.347C916.192,72.012,900.8,86.998,853.893,86.998z M526.265,80.945 c-6.517-0.562-13.599-0.879-21.41-0.879c-70.799,0-91.337,27.229-134.433,35.662c14.901,3.72,32.118,6.07,52.898,6.07 C470.171,121.797,500.34,103.421,526.265,80.945z" fill-opacity=".3" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/><path d="M663.458,109.671c-67.137,0-80.345-23.824-137.193-28.726C567.086,45.555,597.381,0,665.691,0 c61.857,0,85.369,27.782,110.246,51.947C736.888,74.434,717.459,109.671,663.458,109.671z M217.68,94.163 c55.971,0,62.526,24.026,126.337,24.026c9.858,0,18.508-0.916,26.404-2.461c-57.186-14.278-80.177-48.808-138.659-48.808 c-77.063,0-99.96,48.569-151.751,48.569c-40.006,0-60.008-12.206-80.011-29.506v16.806c20.003,10.891,40.005,21.782,80.011,21.782 C160.014,124.57,158.608,94.163,217.68,94.163z M1200.112,46.292c-57.493,0-56.935,46.595-115.015,46.595 c-53.612,0-59.755-39.618-115.602-39.618c-15.267,0-25.381,3.751-34.69,8.749c36.096,26.675,60.503,62.552,117.342,62.552 c69.249,0,75.951-43.559,147.964-43.559c39.804,0,59.986,10.943,79.888,21.777V85.982 C1260.097,68.771,1239.916,46.292,1200.112,46.292z" fill-opacity=".5" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/><path d="M1052.147,124.57c-56.84,0-81.247-35.876-117.342-62.552c-18.613,9.994-34.005,24.98-80.912,24.98 c-38.859,0-58.811-16.455-77.956-35.051c-39.05,22.487-58.479,57.724-112.48,57.724c-67.137,0-80.345-23.824-137.193-28.726 c-25.925,22.475-56.093,40.852-102.946,40.852c-20.779,0-37.996-2.349-52.898-6.07c-7.895,1.545-16.546,2.461-26.404,2.461 c-63.811,0-70.366-24.026-126.337-24.026c-59.072,0-57.665,30.407-137.669,30.407c-40.006,0-60.008-10.891-80.011-21.782V140h1280 v-37.212c-19.903-10.835-40.084-21.777-79.888-21.777C1128.098,81.011,1121.397,124.57,1052.147,124.57z" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/></g></svg>',
			'<svg viewBox="0 0 1280 140" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><g><path d="M0 140h1280C573.08 140 0 0 0 0z" style="transform: rotate(180deg); transform-origin:50% 50%;"/></g></svg>',
			'<svg viewBox="0 0 1280 140" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><g><path d="M0 51.76c36.21-2.25 77.57-3.58 126.42-3.58 320 0 320 57 640 57 271.15 0 312.58-40.91 513.58-53.4V0H0z" fill-opacity=".3" style="fill-rule:evenodd;"/><path d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V0H0z" fill-opacity=".5" style="fill-rule:evenodd; "/><path d="M0 0v3.4C28.2 1.6 59.4.59 94.42.59c320 0 320 84.3 640 84.3 285 0 316.17-66.85 545.58-81.49V0z" style="fill-rule:evenodd; "/></g></svg>',
			'<svg version="1.1" x="0px" y="0px" viewBox="0 0 240 24" xml:space="preserve" preserveAspectRatio="none"><path d="M138.75,22.41c-5.43,0.619-12.363-0.09-18.125-1.27c-5.654-1.19-17.017-5.711-24.116-8.642 C78.34,4.689,64.438,1.708,50.312,0.429c-5.664-0.5-11.685-0.84-24.814,0.62C12.358,2.499,0,7.249,0,7.249V24h240v-7.34 c0,0-17.285-7.921-38.018-7.381c-9.404,0.17-22.275,1.61-32.158,5.442c-5.098,1.959-12.539,4.409-19.121,5.879 C144.17,22.061,141.191,22.17,138.75,22.41z" style="transform: rotate(180deg); transform-origin:50% 50%;"></path></svg>',
			'<svg viewBox="0 0 1280 140" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><g><path d="M0 47.44L170 0l626.48 94.89L1110 87.11l170-39.67V140H0V47.44z" fill-opacity=".5" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/><path d="M0 90.72l140-28.28 315.52 24.14L796.48 65.8 1140 104.89l140-14.17V140H0V90.72z" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/></g></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0 100 C40 0 60 0 100 100 Z" style="transform: rotate(180deg); transform-origin:50% 50%;"></path></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" version="1.1"  viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0 100 C 20 0 50 0 100 100 Z" style="transform: rotate(180deg); transform-origin:50% 50%;"></path></svg>',
			'<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none"><path d="M0 0 L50 100 L100 0 Z" style="transform: rotate(180deg); transform-origin:50% 50%;"></path></svg>',
			'<svg viewBox="0 0 1280 140" xmlns="http://www.w3.org/2000/svg"><path d="M0 0l64.8 30.95 91.2-2.54 95.46 27.87 120.04.2L443 83.15l90.09-3.12L640 110.12l102.39-29.73 85.55 8.51 88.11-5.75L992 52.22l73.21 4.26L1132 38.79l77-.33L1280 0v140H0V0z" fill-opacity=".5" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/><path d="M0 0l64.8 38.69 91.2-3.18 95.46 34.84 120.04.24 71.5 33.35 90.09-3.91L640 137.65l102.39-37.17 85.55 10.65 88.11-7.19L992 65.28l73.21 5.31 66.79-22.1 77-.41L1280 0v140H0V0z" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/></svg>',
			'<svg width="100%" height="250px" viewBox="0 0 1280 140" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M1280 0l-266 91.52a72.59 72.59 0 0 1-30.76 3.71L0 0v140h1280z" fill-opacity=".5" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/><path d="M1280 0l-262.1 116.26a73.29 73.29 0 0 1-39.09 6L0 0v140h1280z" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/></svg>',
			'<svg width="100%" height="100px" viewBox="0 0 1280 140" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 140h1280C573.08 140 0 0 0 0z" fill-opacity=".3" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/><path d="M0 140h1280C573.08 140 0 30 0 30z" fill-opacity=".5" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/><path d="M0 140h1280C573.08 140 0 60 0 60z" style="fill-rule:evenodd; transform: rotate(180deg); transform-origin:50% 50%;"/></svg>',
			);

			$shape = apply_filters('gutentor_post_module_shape_list', $shape);
			return $shape;
		}


        /**
		 * Run Block
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function run(){
            /*Block Specific PHP hooks*/
            $this->add_filter( 'gutentor_post_module_main_wrap_class', $this, 'add_main_wrap_classes',10,2);
            $this->add_filter( 'gutentor_post_module_before_container', $this, 'addAdvancedVideoOutput',10,2);
            $this->add_filter( 'gutentor_post_module_container_class', $this, 'add_container_remove_space_classes',15,2);
            $this->add_filter( 'gutentor_post_module_grid_row_class', $this, 'add_row_remove_space_classes',15,2);
            $this->add_filter( 'gutentor_post_module_grid_column_class', $this, 'add_column_remove_space_classes',15,2);
            $this->add_filter( 'gutentor_post_module_p2_grid_class', $this, 'add_column_remove_space_classes',15,2);
            $this->add_filter( 'gutentor_post_module_before_container', $this, 'addAdvancedBlockShapeTop',15,2);
            $this->add_filter( 'gutentor_post_module_after_container', $this, 'addAdvancedBlockShapeBottom',15,2);
            $this->add_filter( 'gutentor_save_item_image_display_data', $this, 'add_link_to_post_thumbnails',15,3);
            $this->add_filter( 'gutentor_post_module_grid_column_class', $this, 'add_column_class',10,2);
            $this->add_filter( 'gutentor_save_link_attr', $this, 'addButtonLinkAttr',10,3);
            $this->add_filter( 'gutentor_post_module_main_wrap_class', $this, 'addingBlogStyleOptionsClass',15,2);
            $this->add_filter( 'gutentor_post_module_enable_column', $this, 'remove_column_class_blog_post',8,2);

		}

		/**
		 * Adding Google Map Section Classes
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return {array}
		 */
		public function add_main_wrap_classes( $output, $attributes ){

			$gutentorBlockName      = (isset($attributes['gName'])) ? $attributes['gName'] : '';
			$block_list             = array('gutentor/p1','gutentor/p2');
			$block_list             = apply_filters('gutentor_post_module_main_wrap_class_accessor_block',$block_list);
			if(!in_array($gutentorBlockName , $block_list)){
				return $output;
			}

			$local_data                  = '';

            $elementAnimation =  isset($attributes['mAnimation']) ? $attributes['mAnimation'] : false;
            $has_animation = ($elementAnimation && array_key_exists('Animation',$attributes['mAnimation'])) ? $attributes['mAnimation']['Animation'] :false;
            $animation_class  =   ($has_animation && 'none' != $has_animation) ? gutentor_concat_space('wow animated ', $has_animation): '';
			$local_data =  gutentor_concat_space($local_data, $animation_class);

			/*Section Enable Position*/
			$enable_position     = (isset($attributes['mOnPos'])) ? $attributes['mOnPos'] : false;
			if($enable_position){
				/*Section Desktop Position*/
				$position_desktop      = ($attributes['mPosTypeD']) ? $attributes['mPosTypeD'].'-desktop' : false;
				$local_data          = gutentor_concat_space($local_data, $position_desktop);

				/*Section Tablet Position*/
				$position_tablet      = ($attributes['mPosTypeT']) ? $attributes['mPosTypeT'].'-tablet' : false;
				$local_data          = gutentor_concat_space($local_data, $position_tablet);

				/*Section Mobile Position*/
				$position_mobile      = ($attributes['mPosTypeM']) ? $attributes['mPosTypeM'].'-mobile' : false;
				$local_data           = gutentor_concat_space($local_data, $position_mobile);

			}

            $blockComponentBGType = (isset($attributes['mBGType'])) ? $attributes['mBGType'] : '';
			if($blockComponentBGType){
                /* Bg classes */
                $bg_class = GutentorBackgroundOptionsCSSClasses($blockComponentBGType);
                $local_data = gutentor_concat_space($local_data, $bg_class);
            }

			/*Section Desktop Display*/
			if(isset($attributes['mHideMode'])){
				$section_desktop      = array_key_exists('desktop',$attributes['mHideMode']) && $attributes['mHideMode']['desktop'] ? 'd-lg-none' : '';
				$local_data           = gutentor_concat_space($local_data, $section_desktop);

				/*Section Tablet Display*/
				$section_tablet      = array_key_exists('tablet',$attributes['mHideMode']) && $attributes['mHideMode']['tablet'] ? 'd-md-none d-lg-block' : '';
				$local_data          = gutentor_concat_space($local_data, $section_tablet);

				/*Section Mobile Display*/
				$section_mobile      = array_key_exists('mobile',$attributes['mHideMode']) && $attributes['mHideMode']['mobile'] ? 'd-none d-sm-block' : '';
				$local_data          = gutentor_concat_space($local_data, $section_mobile);
			}

            /*Overlay classes*/
            $enable_overlay = (isset($attributes['mOnOverlay'])) ? $attributes['mOnOverlay'] : false;
            if($enable_overlay){
                $overlay    = $enable_overlay ? 'has-gutentor-overlay' : '';
                $local_data = gutentor_concat_space($local_data, $overlay);
            }

            /*enable featured image width*/
            if(isset($attributes['pOnImgBxWidth']) && isset($attributes['pImgBxWidth']) ){
                $enable_width_img     = ($attributes['pOnImgBxWidth'] && $attributes['pImgBxWidth']) ? 'gutentor-enabled-width' : '';
                $local_data           = gutentor_concat_space($local_data,$enable_width_img);
            }

            /*add list reverse class name*/
            if(isset($attributes['gStyle']) && $attributes['pReverseContent'] ){
                $list_reverse_class     = ($attributes['pReverseContent'] && 'gutentor-blog-list' === $attributes['gStyle']) ? 'gutentor-reverse-list' : '';
                $local_data           = gutentor_concat_space($local_data,$list_reverse_class);
            }

            /*content vertical align class*/
            $module_height_enable  = (isset($attributes['mOnHeight'])) ? $attributes['mOnHeight'] : false;
            $module_height  = (isset($attributes['mHeight'])) ? $attributes['mHeight'] : false;
            $module_height_desktop  = ($module_height && isset($attributes['mHeight']['desktop'])) ? $attributes['mHeight']['desktop'] : false;
            $module_height_tablet  = ($module_height && isset($attributes['mHeight']['tablet'])) ? $attributes['mHeight']['tablet'] : false;
            $module_height_mobile  = ($module_height && isset($attributes['mHeight']['mobile'])) ? $attributes['mHeight']['mobile'] : false;

            $align_enable  = (isset($attributes['mContOnVAlign']) )? $attributes['mContOnVAlign'] : false;
            $align_mobile  = (isset($attributes['mContVAlign']) )? $attributes['mContVAlign'] : false;
            $align_tablet  = (isset($attributes['mContVAlignT']) )? $attributes['mContVAlignT'] : false;
            $align_desktop  = (isset($attributes['mContVAlignD']) )? $attributes['mContVAlignD'] : false;

            $vertical_align_condition = ($module_height_enable && $module_height && ($module_height_desktop || $module_height_tablet || $module_height_mobile));
            if($vertical_align_condition && $align_enable){

                $align_m_class     = ($align_mobile) ? $align_mobile.'-mobile': '';
                $local_data           = gutentor_concat_space($local_data,$align_m_class);

                $align_t_class     = ($align_tablet) ? $align_tablet.'-tablet': '';
                $local_data           = gutentor_concat_space($local_data,$align_t_class);

                $align_d_class     = ($align_desktop) ? $align_desktop.'-desktop': '';
                $local_data           = gutentor_concat_space($local_data,$align_d_class);

            }
            /*add categories position class name*/
            if(isset($attributes['pPostCatPos']) && $attributes['pPostCatPos'] ){
                $cat_position_class     = ($attributes['pPostCatPos']) ? $attributes['pPostCatPos'] : '';
                $local_data           = gutentor_concat_space($local_data,$cat_position_class);
            }

            /*add post format Position class name*/
            if(isset($attributes['pPostFormatPos']) && $attributes['pPostFormatPos'] ){
                $post_format_position_class     = ($attributes['pPostFormatPos']) ? $attributes['pPostFormatPos'] : '';
                $local_data           = gutentor_concat_space($local_data,$post_format_position_class);
            }

            /*Shape Top select classes*/
            $blockShapeTopSelect = (isset($attributes['mTShape'])) ? true : false;
            if($blockShapeTopSelect){
                $blockShapeTopSelectClass = $blockShapeTopSelect ? 'has-gutentor-block-shape-top' : '';
                $local_data = gutentor_concat_space($local_data, $blockShapeTopSelectClass);
            }

            /*Shape Bottom select classes*/
            $blockShapeBottomSelect = (isset($attributes['mBShape'])) ? true : false;
            if($blockShapeBottomSelect){
                $blockShapeBottomSelectClass = $blockShapeBottomSelect ? 'has-gutentor-block-shape-bottom' : '';
                $local_data = gutentor_concat_space($local_data, $blockShapeBottomSelectClass);
            }

            /*mTShapePos select classes*/
            $mTShapePos = (isset($attributes['mTShapePos'])) ? $attributes['mTShapePos'] : false;
            if($mTShapePos){
                $mTShapePos = $mTShapePos ? 'gutentor-block-shape-top-bring-front' : '';
                $local_data = gutentor_concat_space($local_data, $mTShapePos);
            }

            /*mBShapePos select classes*/
            $mBShapePos = (isset($attributes['mBShapePos'])) ? $attributes['mBShapePos'] : false;
            if($mBShapePos){
                $mBShapePos = $mBShapePos ? 'gutentor-block-shape-bottom-bring-front' : '';
                $local_data = gutentor_concat_space($local_data, $mBShapePos);
            }

            /*mTShapeVFlip select classes*/
            $mTShapeVFlip = (isset($attributes['mTShapeVFlip'])) ? $attributes['mTShapeVFlip'] : false;
            if($mTShapeVFlip){
                $local_data = gutentor_concat_space($local_data, 'gutentor-tshape-fv');
            }

            /*mTShapeHFlip select classes*/
            $mTShapeHFlip = (isset($attributes['mTShapeHFlip'])) ? $attributes['mTShapeHFlip'] : false;
            if($mTShapeHFlip){
                $local_data = gutentor_concat_space($local_data, 'gutentor-tshape-hv');
            }

            /*mTShapeHFlip select classes*/
            $mBShapeVFlip = (isset($attributes['mBShapeVFlip'])) ? $attributes['mBShapeVFlip'] : false;
            if($mBShapeVFlip){
                $local_data = gutentor_concat_space($local_data,'gutentor-bshape-fv');
            }

            /*mTShapeHFlip select classes*/
            $mBShapeHFlip = (isset($attributes['mBShapeHFlip'])) ? $attributes['mBShapeHFlip'] : false;
            if($mBShapeHFlip){
                $local_data = gutentor_concat_space($local_data,'gutentor-bshape-hv');
            }

            /*Concat Output with local data*/
			$local_data = gutentor_concat_space($output, $local_data);

			return $local_data;


		}

        /**
         * Advanced Options Video Output
         * @param {object} output
         * @param {object} props
         * @return {object} Inline CSS
         */
        public function addAdvancedVideoOutput($output, $attributes)
        {
            $gutentorBlockName = (isset($attributes['gName'])) ? $attributes['gName'] : '';
            $block_list = array('gutentor/p1');
            $block_list = apply_filters('gutentor_post_block_access_bg_video_html', $block_list);
            if (!in_array($gutentorBlockName, $block_list)) {
                return $output;
            }
            $blockComponentBGType = (isset($attributes['mBGType'])) ? $attributes['mBGType'] : '';
            if ('video' !== $blockComponentBGType) {
                return $output;
            }
            $blockComponentBGVideo = (isset($attributes['mBGVideo'])) ? $attributes['mBGVideo'] : '';
            if(!$blockComponentBGVideo){
                return $output;
            }
            $blockComponentBGVideoLoop = (isset($attributes['mBGVideoLoop'])) ? $attributes['mBGVideoLoop'] : '';
            $blockComponentBGVideoMuted = (isset($attributes['mBGVideoMute'])) ? $attributes['mBGVideoMute'] : '';
            $videoOutput = GutentorBackgroundVideoOutput($blockComponentBGType, $blockComponentBGVideo, $blockComponentBGVideoLoop, $blockComponentBGVideoMuted);
            if($videoOutput){
                $output = gutentor_concat_space($output, $videoOutput);
            }
            return $output;
        }

		/**
		 * Adding Container Remove Classes
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return string
		 */
		public function add_container_remove_space_classes( $output, $attributes ){

			$gutentorBlockName      = (isset($attributes['gName'])) ? $attributes['gName'] : '';
			$block_list             = array('gutentor/p1','gutentor/p2');
			$block_list             = apply_filters('gutentor_post_module_container_remove_space_accessor_block',$block_list);
			if(!in_array($gutentorBlockName , $block_list)){
				return $output;
			}
			$local_data                  = '';

			/*Section Desktop Display*/
			if(isset($attributes['mHideContSpace'])){
				$section_desktop      = array_key_exists('desktop',$attributes['mHideContSpace']) && $attributes['mHideContSpace']['desktop'] ? 'gutentor-rm-ct-space-d' : '';
				$local_data           = gutentor_concat_space($local_data, $section_desktop);

				/*Section Tablet Display*/
				$section_tablet      = array_key_exists('tablet',$attributes['mHideContSpace']) && $attributes['mHideContSpace']['tablet'] ? 'gutentor-rm-ct-space-t' : '';
				$local_data          = gutentor_concat_space($local_data, $section_tablet);

				/*Section Mobile Display*/
				$section_mobile      = array_key_exists('mobile',$attributes['mHideContSpace']) && $attributes['mHideContSpace']['mobile'] ? 'gutentor-rm-ct-space' : '';
				$local_data          = gutentor_concat_space($local_data, $section_mobile);
			}

			$local_data = gutentor_concat_space($output, $local_data);
			return $local_data;

		}



		/**
		 * Adding Container Remove Classes
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return string
		 */
		public function add_row_remove_space_classes( $output, $attributes ){

			$gutentorBlockName      = (isset($attributes['gName'])) ? $attributes['gName'] : '';
			$block_list             = array('gutentor/p1','gutentor/p2');
			$block_list             = apply_filters('gutentor_post_module_row_remove_space_accessor_block',$block_list);
			if(!in_array($gutentorBlockName , $block_list)){
				return $output;
			}
			$local_data                  = '';

			/*Section Desktop Display*/
			if(isset($attributes['mHideRowSpace'])){
				$section_desktop      = array_key_exists('desktop',$attributes['mHideRowSpace']) && $attributes['mHideRowSpace']['desktop'] ?'gutentor-rm-row-space-d' : '';
				$local_data           = gutentor_concat_space($local_data, $section_desktop);

				/*Section Tablet Display*/
				$section_tablet      = array_key_exists('tablet',$attributes['mHideRowSpace']) && $attributes['mHideRowSpace']['tablet'] ? 'gutentor-rm-row-space-t' : '';
				$local_data          = gutentor_concat_space($local_data, $section_tablet);

				/*Section Mobile Display*/
				$section_mobile      = array_key_exists('mobile',$attributes['mHideRowSpace']) && $attributes['mHideRowSpace']['mobile'] ? 'gutentor-rm-row-space' : '';
				$local_data          = gutentor_concat_space($local_data, $section_mobile);
			}

			$local_data = gutentor_concat_space($output, $local_data);
			return $local_data;

		}


		/**
		 * Adding Container Remove Classes
		 *
		 * @param {array} output
		 * @param {object} props
		 * @return string
		 */
		public function add_column_remove_space_classes( $output, $attributes ){

			$gutentorBlockName      = (isset($attributes['gName'])) ? $attributes['gName'] : '';
			$block_list             = array('gutentor/p1','gutentor/p2');
			$block_list             = apply_filters('gutentor_post_module_col_remove_space_accessor_block',$block_list);
			if(!in_array($gutentorBlockName , $block_list)){
				return $output;
			}
			$local_data                  = '';

			/*Section Desktop Display*/
			if(isset($attributes['mHideColSpace'])){
				$section_desktop      = array_key_exists('desktop',$attributes['mHideColSpace']) && $attributes['mHideColSpace']['desktop'] ?'gutentor-rm-col-space-d' : '';
				$local_data           = gutentor_concat_space($local_data, $section_desktop);

				/*Section Tablet Display*/
				$section_tablet      = array_key_exists('tablet',$attributes['mHideColSpace']) && $attributes['mHideColSpace']['tablet'] ? 'gutentor-rm-col-space-t' : '';
				$local_data          = gutentor_concat_space($local_data, $section_tablet);

				/*Section Mobile Display*/
				$section_mobile      = array_key_exists('mobile',$attributes['mHideColSpace']) && $attributes['mHideColSpace']['mobile'] ? 'gutentor-rm-col-space' : '';
				$local_data          = gutentor_concat_space($local_data, $section_mobile);
			}

			$local_data = gutentor_concat_space($output, $local_data);
			return $local_data;

		}


        /**
         * Advanced Block Shape Before Container
         * @param {string} $output
         * @return {object} $attributes
         */
        public function addAdvancedBlockShapeTop($output, $attributes) {

        	if (!isset( $attributes['mTShape']) || is_null( $attributes['mTShape']) ) {
                return $output;
            }
            $shape = $this->blockShapeDividerSvgArray();
            $shape_data = '<div class="gutentor-block-shape-top"><span>' .  $shape[$attributes['mTShape']] . '</span></div>';
            return $output.$shape_data;
        }

        /**
         * Advanced Block Shape Before Container
         * @param {string} $output
         * @return {object} $attributes
         */
        public function addAdvancedBlockShapeBottom($output, $attributes) {

	        if (!isset( $attributes['mBShape']) || is_null( $attributes['mBShape']) ) {
		        return $output;
	        }
	        $shape = $this->blockShapeDividerSvgArray();
            $shape_data = '<div class="gutentor-block-shape-bottom"><span>' . $shape[$attributes['mBShape']] . '</span></div>';
            return $output.$shape_data;
        }
        

        /**
         * Adding Link to Post Thumbnails
         *
         * @param {array} output
         * @param {object} props
         * @return {array}
         */
        public function add_link_to_post_thumbnails($output,$url, $attributes) {
	        $output_wrap = '';
	        $target      = '';
	        $rel      = '';
	        if ( empty( $output ) || $output == null ) {
		        return $output;
	        }
	        if ( !array_key_exists( 'pImgOnLink', $attributes ) ) {
		        return $output;
	        }
	        if ( ! $attributes['pImgOnLink'] ) {
		        return $output;
	        }
	        if (array_key_exists( 'pImgOpenNewTab', $attributes ) ) {
		        $target = $attributes['pImgOpenNewTab'] ?  'target="_blank"' : '';
	        }
	        if (array_key_exists( 'pImgLinkRel', $attributes ) ) {
		        $rel = ($attributes['pImgLinkRel']) ? 'rel="'.$attributes['pImgLinkRel'].'"' : '';

	        }
            $output_wrap .= '<a class="gutentor-post-image-link" href="'.$url.'" '.$target.' '.$rel.'>';
            $output_wrap .= $output;
            $output_wrap .= '</a>';
            return $output_wrap;

        }

        /**
         * Adding Block Header
         *
         * @param {array} output
         * @param {object} props
         * @return {array}
         */
        public function add_column_class( $output, $attributes ){

	        $gutentorBlockName      = (isset($attributes['gName'])) ? $attributes['gName'] : '';
	        $block_list             = array('gutentor/p1');
	        $block_list             = apply_filters('gutentor_post_module_column_class_accessor_block',$block_list);
	        if(!in_array($gutentorBlockName , $block_list)){
		        return $output;
	        }

	        if(!apply_filters('gutentor_post_module_enable_column',true, $attributes ) ){
		        return $output;
	        }

            $local_data               = '';
            $blockItemsColumn_desktop = (isset($attributes['blockItemsColumn']['desktop'])) ? $attributes['blockItemsColumn']['desktop'] : '';
            $local_data               = gutentor_concat_space($local_data, $blockItemsColumn_desktop);
            $blockItemsColumn_tablet  = (isset($attributes['blockItemsColumn']['tablet'])) ? $attributes['blockItemsColumn']['tablet'] : '';
            $local_data               = gutentor_concat_space($local_data, $blockItemsColumn_tablet);
            $blockItemsColumn_mobile  = (isset($attributes['blockItemsColumn']['mobile'])) ? $attributes['blockItemsColumn']['mobile'] : '';
            $local_data               = gutentor_concat_space($local_data, $blockItemsColumn_mobile);

            return gutentor_concat_space($output, $local_data);
        }
        

        /**
         * Add Button Attributes
         *
         * @param {object} output
         * @param {string} buttonLink
         * @param {object} buttonLinkOptions
         * @return {object}
         */
        public function addButtonLinkAttr( $output,$buttonLink, $buttonLinkOptions ){

            $target     = $buttonLinkOptions['openInNewTab'] ? '_blank' : '';
            $rel        = ($buttonLinkOptions['rel']) ? $buttonLinkOptions['rel'] : '';
            $a_href     = ($buttonLink) ? 'href="' . $buttonLink . '"' : '';
            $a_target   = ($target) ? 'target="' . $target . '" ' : '';
            $local_data = gutentor_concat_space($a_href, $a_target);
            $a_rel      = ($rel) ? 'rel="' . $rel . '" ' : '';
            $local_data = gutentor_concat_space($local_data, $a_rel);
            return gutentor_concat_space($output, $local_data);
        }
        

        /**
         * Adding Class
         *
         * @param {array} output
         * @param {object} props
         * @return {array}
         */
        public function addingBlogStyleOptionsClass( $output, $attributes ){

            if( 'gutentor/p1' !== $attributes['gName']){
                return $output;
            }
            $blog_style_class =  $attributes['gStyle'] ? $attributes['gStyle'] : '';
            return gutentor_concat_space($output, $blog_style_class);
        }

        /**
         * Remove Column Class in Blog post
         *
         * @param {array} output
         * @param {object} attributes
         * @return string
         */
        public function remove_column_class_blog_post($output, $attributes) {

            if ('gutentor/p1' !== $attributes['gName']) {
                return $output;
            }
            if ($attributes['gStyle'] === 'gutentor-blog-list') {
                return false;
            }
            return $output;
        }

	}
}

/**
 * Return instance of  Gutentor_Post_Module_Hooks class
 *
 * @since    1.0.0
 */
if( !function_exists( 'gutentor_post_module_hooks')){

	function gutentor_post_module_hooks() {

		//return Gutentor_Post_Module_Hooks::get_instance();
		return Gutentor_Post_Module_Hooks::get_instance()->run();
	}
}
gutentor_post_module_hooks();