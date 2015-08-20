<?php

/**
 * Facebook content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Facebook' ) ) {
	class PT_VC_Facebook extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_facebook'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'            => 'Facebook',
				'fb_page_url'      => 'https://www.facebook.com/ProteusThemes',
				'width'            => 340,
				'height'           => 500,
				'checkbox_options' => '',
				), $atts );

			// Prepare check-boxes data
			$atts['checkbox_options'] = explode( ',', $atts['checkbox_options'] );

			$all_checkbox_options = array(
				'hide_cover',
				'show_facepile',
				'show_posts',
				'small_header',
			);

			$fb_params_options = array();

			foreach ( $atts['checkbox_options'] as $option ) {
				if ( in_array( $option , $all_checkbox_options ) ) {
					$fb_params_options[ $option ] = true;
				}
			}

			$instance = array(
				'title'     => $atts['title'],
				'like_link' => $atts['fb_page_url'],
				'width'     => $atts['width'],
				'height'    => $atts['height'],
			);

			$instance = array_merge( $instance, $fb_params_options );

			ob_start();
			the_widget( 'PW_Facebook', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Facebook Box', 'cargopress-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Social', 'cargopress-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Title', 'cargopress-pt' ),
						'param_name'  => 'title',
						'value'       => 'Facebook',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'FB Page to like', 'cargopress-pt' ),
						'description' => __( 'Input the whole FB page url. Example: https://www.facebook.com/ProteusThemes', 'cargopress-pt' ),
						'param_name'  => 'fb_page_url',
						'value'       => 'https://www.facebook.com/ProteusThemes',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Width', 'cargopress-pt' ),
						'description' => __( 'Input width in pixels. Min: 180, Max: 500', 'cargopress-pt' ),
						'param_name'  => 'width',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Height', 'cargopress-pt' ),
						'description' => __( 'Input height in pixels. Min: 70', 'cargopress-pt' ),
						'param_name'  => 'height',
					),
					array(
						'type'        => 'checkbox',
						'heading'     => __( 'Options', 'cargopress-pt' ),
						'param_name'  => 'checkbox_options',
						'value'       => array(
							'Hide Cover Photo'     => 'hide_cover',
							'Hide Friend\'s Faces' => 'show_facepile',
							'Show Page Posts'      => 'show_posts',
							'Use Small Header'     => 'small_header',
						),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Facebook;
}