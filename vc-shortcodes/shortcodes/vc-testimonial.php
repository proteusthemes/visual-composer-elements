<?php

/**
 * Testimonial content element for the Visual Composer editor,
 * that can only be used in the Testimonials container
 */

if ( ! class_exists( 'PT_VC_Testimonial' ) ) {
	class PT_VC_Testimonial extends PT_VC_Shortcode {

		private $fields;

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_testimonial'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'quote'              => '',
				'author'             => '',
				'author_description' => '',
				), $atts );

			// Remove all HTML tags from the testimonial text
			$atts['quote'] = wp_strip_all_tags( $atts['quote'] );

			// The PHP_EOL is added so that it can be used as a separator between multiple counters
			return PHP_EOL . json_encode( $atts );
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {

			$this->fields = apply_filters( 'pw/testimonial_widget', array(
				'rating' => true,
				'author_description' => false,
				'number_of_testimonial_per_slide' => 2,
			) );

			$params = array(
				array(
					'type'        => 'textarea',
					'heading'     => _x( 'Quote', 'backend', 'vc-elements-pt' ),
					'param_name'  => 'quote',
				),
				array(
					'type'        => 'textfield',
					'heading'     => _x( 'Author', 'backend', 'vc-elements-pt' ),
					'param_name'  => 'author',
				),
			);

			if ( $this->fields['author_description'] ) {
				$params[] = array(
					'type'        => 'textfield',
					'heading'     => _x( 'Author Description', 'backend', 'vc-elements-pt' ),
					'param_name'  => 'author_description',
				);
			}

			vc_map( array(
				'name'     => _x( 'Testimonial', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_child' => array( 'only' => 'pt_vc_container_testimonials' ),
				'params'   => $params
			) );
		}
	}

	// Initialize the class
	new PT_VC_Testimonial;
}