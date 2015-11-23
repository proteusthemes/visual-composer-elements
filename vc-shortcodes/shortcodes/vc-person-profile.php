<?php

/**
 * Call to Action content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Person_Profile' ) ) {
	class PT_VC_Person_Profile extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_person_profile'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'name'         => '',
				'title'        => '',
				'image_url'    => '',
				'introduction' => '',
				'new_tab'      => '',
				'social_links' => '',
				), $atts );

			// Prepare social icons for the Person Profile widget
			$lines        = explode( PHP_EOL , $atts['social_links'] );
			$social_icons = array();

			foreach ( $lines as $line ) {
				$split_line = explode( '|', $line );
				$tmp_array  = array(
					'link' => wp_strip_all_tags( $split_line[0] ),
					'icon' => wp_strip_all_tags( $split_line[1] ),
				);
				$social_icons[] = $tmp_array;
			}

			$instance = array(
				'name'         => $atts['name'],
				'tag'          => $atts['title'],
				'image'        => $atts['image_url'],
				'description'  => $atts['introduction'],
				'new_tab'      => $atts['new_tab'],
				'social_icons' => $social_icons,
			);

			ob_start();
			the_widget( 'PW_Person_Profile', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Person Profile', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'textfield',
						'holder'     => 'div',
						'heading'    => _x( 'Name', 'backend', 'vc-elements-pt' ),
						'param_name' => 'name',
						'value'      => esc_html__( 'Jeff Lopez', 'vc-elements-pt' ),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Title', 'backend', 'vc-elements-pt' ),
						'param_name' => 'title',
						'value'      => esc_html__( 'CEO and Founder', 'vc-elements-pt' ),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Picture URL', 'backend', 'vc-elements-pt' ),
						'param_name' => 'image_url',
						'value'      => 'http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/06/110.jpg',
					),
					array(
						'type'       => 'textarea',
						'heading'    => _x( 'Introduction', 'backend', 'vc-elements-pt' ),
						'param_name' => 'introduction',
						'value'      => esc_html__( 'This is my bio...', 'vc-elements-pt' ),
					),
					array(
						'type'       => 'checkbox',
						'heading'    => _x( 'Open link in new tab', 'backend', 'vc-elements-pt' ),
						'param_name' => 'new_tab',
					),
					array(
						'type'        => 'lined_textarea',
						'heading'     => _x( 'Social icons', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Enter values for social links - <em>URL</em>|<em>font awesome icon class name</em>. Divide value sets with linebreak "Enter" (Example: https://www.facebook.com/ProteusThemes|fa-facebook-square).', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'social_links',
						'rows'        => '5',
						'value'       => 'https://www.facebook.com/ProteusThemes|fa-facebook-square,https://www.linkedin.com|fa-linkedin-square,https://twitter.com/proteusthemes|fa-twitter-square,https://www.youtube.com/user/ProteusNetCompany/|fa-youtube-square',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Person_Profile;
}