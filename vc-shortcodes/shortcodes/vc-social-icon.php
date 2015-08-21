<?php

/**
 * Social Icon content element for the Visual Composer editor,
 * that can only be used in the Social Icons container
 */

if ( ! class_exists( 'PT_VC_Social_Icon' ) ) {
	class PT_VC_Social_Icon extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_social_icon'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'link'    => '',
				'icon'    => 'fa fa-facebook',
				), $atts );

			// Extract the icon class without the first 'fa' part
			$icon = explode( ' ', $atts['icon'] );
			$atts['icon'] = $icon[1];

			// The PHP_EOL is added so that it can be used as a separator between multiple counters
			return PHP_EOL . json_encode( $atts );
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Social Icon', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_child' => array( 'only' => 'pt_vc_container_social_icons' ),
				'params'   => array(
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Link', 'backend', 'vc-elements-pt' ),
						'param_name' => 'link',
					),
					array(
						'type'        => 'iconpicker',
						'heading'     => _x( 'Icon', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'icon',
						'value'       => 'fa fa-facebook',
						'description' => _x( 'Select icon from library.', 'backend', 'vc-elements-pt' ),
						'settings'    => array(
							'emptyIcon'    => false,
							'iconsPerPage' => 50,
						),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Social_Icon;
}