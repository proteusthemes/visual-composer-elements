<?php

/**
 * Counter content element for the Visual Composer editor,
 * that can only be used in the Number Counter container
 */

if ( ! class_exists( 'PT_VC_Counter' ) ) {
	class PT_VC_Counter extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_counter'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'  => __( 'Test Title', 'backend', 'vc-elements-pt' ),
				'number' => '299',
				'icon'   => 'fa fa-home',
				), $atts );

			$atts['number'] = absint( $atts['number'] );

			// The PHP_EOL is added so that it can be used as a separator between multiple counters
			return PHP_EOL . json_encode( $atts );
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Counter', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_child' => array( 'only' => 'pt_vc_container_number_counter' ),
				'params'   => array(
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Title', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'title',
					),
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Number', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Input a positive number.', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'number',
						'min'         => '1',
					),
					array(
						'type'        => 'iconpicker',
						'heading'     => _x( 'Icon', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'icon',
						'value'       => 'fa fa-home',
						'description' => _x( 'Select icon from library.', 'backend', 'vc-elements-pt' ),
						'settings'    => array(
							'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							'iconsPerPage' => 100, // default 100, how many icons per/page to display
						),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Counter;
}