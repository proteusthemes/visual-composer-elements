<?php

/**
 * Call to Action content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Brochure_Box' ) ) {
	class PT_VC_Brochure_Box extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_brochure_box'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'   => '',
				'url'     => '',
				'new_tab' => '',
				'text'    => '',
				'icon'    => 'fa-file-text-o',
				), $atts );

			$instance = array(
				'title'         => $atts['title'],
				'brochure_url'  => $atts['url'],
				'brochure_icon' => $atts['icon'],
				'brochure_text' => $atts['text'],
				'new_tab'       => $atts['new_tab'],
			);

			ob_start();
			the_widget( 'PW_Brochure_Box', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Brochure Box', 'cargopress-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Content', 'cargopress-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'textfield',
						'holder'     => 'div',
						'heading'    => __( 'Title', 'cargopress-pt' ),
						'param_name' => 'title',
					),
					array(
						'type'       => 'upload_file',
						'heading'    => __( 'Brochure URL', 'cargopress-pt' ),
						'param_name' => 'url',
					),
					array(
						'type'       => 'checkbox',
						'heading'    => __( 'Open link in new tab', 'cargopress-pt' ),
						'param_name' => 'new_tab',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'div',
						'heading'    => __( 'Brochure Text', 'cargopress-pt' ),
						'param_name' => 'text',
					),
					array(
						'type'       => 'select_fa_icon_bb',
						'heading'    => __( 'Brochure Icon', 'cargopress-pt' ),
						'param_name' => 'icon',
						'value'      => 'fa-file-text-o',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Brochure_Box;
}