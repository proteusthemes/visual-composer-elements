<?php

/**
 * Steps container content element for the Visual Composer editor,
 * that allows nesting of the Step VC content element
 */

if ( ! class_exists( 'PT_VC_Container_Steps' ) ) {
	class PT_VC_Container_Steps extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_container_steps'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'         => '',
				), $atts );

			$items = PT_VC_Helper_Functions::get_child_elements_data( $content );

			$instance = array(
				'title' => $atts['title'],
				'items' => $items,
			);

			ob_start();
				the_widget( 'PW_Steps', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'            => _x( 'Steps', 'backend', 'vc-elements-pt' ),
				'base'            => $this->shortcode_name(),
				'category'        => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'            => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_parent'       => array( 'only' => 'pt_vc_step' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'type'       => 'textfield',
						'holder'     => 'div',
						'heading'    => _x( 'Title', 'backend', 'vc-elements-pt' ),
						'param_name' => 'title',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Container_Steps;

	// The "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Pt_Vc_Container_Steps extends WPBakeryShortCodesContainer {}
	}
}