<?php

/**
 * Skype content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Skype' ) ) {
	class PT_VC_Skype extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_skype'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'    => _x( 'Skype Call', 'backend', 'vc-elements-pt' ),
				'username' => 'skype:echo1234',
				), $atts );

			$instance = array(
				'title'     => $atts['title'],
				'skype_username' => $atts['username'],
			);

			ob_start();
			the_widget( 'PW_Skype', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Skype', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'textfield',
						'holder'     => 'div',
						'heading'    => _x( 'Title', 'backend', 'vc-elements-pt' ),
						'param_name' => 'title',
						'value'      => _x( 'Skype Call', 'backend', 'vc-elements-pt' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Skype username', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Example: <code>skype:your_skype_username_goes_here</code> or <code>tel:your_phone_number</code>, if you want it to call your phone.', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'username',
						'value'       => 'skype:echo1234',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Skype;
}