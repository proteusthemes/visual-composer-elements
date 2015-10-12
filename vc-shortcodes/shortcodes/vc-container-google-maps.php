<?php

/**
 * Google Maps container content element for the Visual Composer editor,
 * that allows nesting of the Location VC content element
 */

if ( ! class_exists( 'PT_VC_Container_Google_Map' ) ) {
	class PT_VC_Container_Google_Map extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_container_google_map'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'lat_long' => '51.5862682,-0.3009941',
				'zoom'     => 7,
				'type'     => 'roadmap',
				'style'    => apply_filters( 'vc_pt/current_theme_google_map_style' , 'CargoPress' ),
				'height'   => 380,
				), $atts );

			$locations = PT_VC_Helper_Functions::get_child_elements_data( $content );

			$instance = array(
				'locations' => $locations,
				'latLng'    => $atts['lat_long'],
				'zoom'      => absint( $atts['zoom'] ),
				'type'      => $atts['type'],
				'style'     => $atts['style'],
				'height'    => absint( $atts['height'] ),
			);

			ob_start();
				the_widget( 'PW_Google_Map', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'            => _x( 'Google Map', 'backend', 'vc-elements-pt' ),
				'base'            => $this->shortcode_name(),
				'category'        => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'            => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_parent'       => array( 'only' => 'pt_vc_location' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Latitude and longitude of the map center', 'backend', 'vc-elements-pt' ),
						'description' => sprintf( __( 'Get this from %s (right click on map and select What\'s here?) or %s. Latitude and longitude separated by comma.', 'vc-elements-pt' ), '<a href="https://maps.google.com/" target="_blank">Google Maps</a>', '<a href="http://www.findlatitudeandlongitude.com/" target="_blank">this site</a>' ),
						'param_name'  => 'lat_long',
						'value'       => '51.5862682,-0.3009941',
					),
					array(
						'type'        => 'dropdown',
						'heading'     => _x( 'Zoom of the map', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Higher number means closer view', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'zoom',
						'value'       => range( 1, 24 ),
						'std'         => 7,
					),
					array(
						'type'        => 'dropdown',
						'heading'     => _x( 'Type', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'type',
						'value'       => array(
							_x( 'Roadmap', 'backend', 'vc-elements-pt' )   => 'roadmap',
							_x( 'Satellite', 'backend', 'vc-elements-pt' ) => 'satellite',
							_x( 'Hybrid', 'backend', 'vc-elements-pt' )    => 'hybrid',
							_x( 'Terrain', 'backend', 'vc-elements-pt' )   => 'terrain',
						),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => _x( 'Style', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'style',
						'value'       => array(
							apply_filters( 'vc_pt/current_theme_google_map_style' , 'CargoPress' ),
							'Default',
							'Subtle Grayscale',
							'Pale Dawn',
							'Blue Water',
							'Gowalla',
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Height of the map', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Input height in pixels', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'height',
						'value'       => 380,
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Container_Google_Map;

	// The "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Pt_Vc_Container_Google_Map extends WPBakeryShortCodesContainer {}
	}
}