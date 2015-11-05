<?php

/**
 * Accordion Item content element for the Visual Composer editor,
 * that can only be used in the Accordion container
 */

if ( ! class_exists( 'PT_VC_Accordion_Item' ) ) {
	class PT_VC_Accordion_Item extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_accordion_item'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'        => '',
				'item_content' => '',
				), $atts );

			$atts['content'] = $atts['item_content'];

			// The PHP_EOL is added so that it can be used as a separator between multiple accordion items
			return PHP_EOL . json_encode( $atts );
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Accordion Item', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_child' => array( 'only' => 'pt_vc_container_accordion' ),
				'params'   => array(
					array(
						'type'        => 'textfield',
						'heading'     => _x( 'Title', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'title',
					),
					array(
						'type'        => 'textarea',
						'heading'     => _x( 'Content', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'item_content',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Accordion_Item;
}