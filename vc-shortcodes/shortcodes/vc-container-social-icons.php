<?php

/**
 * Social Icons container content element for the Visual Composer editor,
 * that allows nesting of the Social Icon VC content element
 */

if ( ! class_exists( 'PT_VC_Container_Social_Icons' ) ) {
	class PT_VC_Container_Social_Icons extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_container_social_icons'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'new_tab' => '',
				), $atts );

			$social_icons = PT_VC_Helper_Functions::get_child_elements_data( $content );

			$instance = array(
				'new_tab'      => $atts['new_tab'],
				'social_icons' => $social_icons,
			);

			ob_start();
				the_widget( 'PW_Social_Icons', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'                    => _x( 'Social Icons', 'backend', 'vc-elements-pt' ),
				'base'                    => $this->shortcode_name(),
				'category'                => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'                    => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_parent'               => array( 'only' => 'pt_vc_social_icon' ),
				'content_element'         => true,
				'js_view'                 => 'VcColumnView',
				'params'                  => array(
					array(
						'type'       => 'checkbox',
						'heading'    => _x( 'Open link in new tab', 'backend', 'vc-elements-pt' ),
						'param_name' => 'new_tab',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Container_Social_Icons;

	// The "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Pt_Vc_Container_Social_Icons extends WPBakeryShortCodesContainer {}
	}
}