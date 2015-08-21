<?php

/**
 * Location content element for the Visual Composer editor,
 * that can only be used in the Google Maps container
 */

if ( ! class_exists( 'PT_VC_Location' ) ) {
	class PT_VC_Location extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_location'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'          => __( 'London', 'vc-elements-pt' ),
				'locationlatlng' => '51.507331,-0.127668',
				'custompinimage' => '',
				), $atts );

			// The PHP_EOL is added so that it can be used as a separator between multiple locations
			return PHP_EOL . json_encode( $atts );
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Location', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_child' => array( 'only' => 'pt_vc_container_google_map' ),
				'params'   => array(
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Title of location', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'This is shown on the pin mouse hover', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'title',
						'value'       => _x( 'London', 'backend', 'vc-elements-pt' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Latitude and longitude of this location', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Example: 51.507331,-0.127668', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'locationlatlng',
						'value'       => '51.507331,-0.127668',
					),
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Custom pin icon URL', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Input the URL of the pin icon image', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'custompinimage',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Location;
}