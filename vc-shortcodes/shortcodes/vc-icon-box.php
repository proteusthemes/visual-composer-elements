<?php

/**
 * Icon Box content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Icon_Box' ) ) {
	class PT_VC_Icon_Box extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_icon_box'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'   => '',
				'text'    => '',
				'link'    => '',
				'new_tab' => '',
				'icon'    => 'fa fa-home',
				), $atts );

			// Extract the icon class without the first 'fa' part
			$icon = explode( ' ', $atts['icon'] );

			$instance = array(
				'title'    => $atts['title'],
				'text'     => $atts['text'],
				'btn_link' => $atts['link'],
				'icon'     => $icon[1],
				'new_tab'  => $atts['new_tab'],
			);

			ob_start();
			the_widget( 'PW_Icon_Box', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Icon Box', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'textfield',
						'holder'     => 'div',
						'heading'    => _x( 'Title', 'backend', 'vc-elements-pt' ),
						'param_name' => 'title',
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Text', 'backend', 'vc-elements-pt' ),
						'param_name' => 'text',
					),
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Link', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'URL to any page, optional.', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'link',
					),
					array(
						'type'       => 'checkbox',
						'heading'    => _x( 'Open link in new tab', 'backend', 'vc-elements-pt' ),
						'param_name' => 'new_tab',
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
	new PT_VC_Icon_Box;
}