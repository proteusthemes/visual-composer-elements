<?php

/**
 * Call to Action content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Call_To_Action' ) ) {
	class PT_VC_Call_To_Action extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_call_to_action'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title' => 'Not sure which solution fits you business needs?',
				), $atts );

			$instance = array(
				'text'        => $atts['title'],
				'button_text' => $content,
			);

			ob_start();
			the_widget( 'PW_Call_To_Action', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Call to Action', 'backend', 'vc-elements-pt' ),
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
						'type'        => 'textarea_html',
						'class'       => '',
						'heading'     => _x( 'Button Area', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'content',
						'description' => _x( 'For adding buttons you must use button shortcode which look like this: [button]Text[/button]. Please take a look at the documentation for more details.', 'backend', 'vc-elements-pt' ),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Call_To_Action;
}