<?php

/**
 * Featured Page content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Featured_Page' ) ) {
	class PT_VC_Featured_Page extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_featured_page'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'page'           => '',
				'layout'         => 'block',
				'read_more_text' => __( 'Read more', 'vc-elements-pt' ),
				), $atts );

			$instance = array(
				'page_id'        => absint( $atts['page'] ),
				'layout'         => $atts['layout'],
				'read_more_text' => $atts['read_more_text'],
			);

			ob_start();
			the_widget( 'PW_Featured_Page', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {

			// Get all pages to use in the dropdown below:
			$args = array(
				'sort_order'  => 'ASC',
				'sort_column' => 'post_title',
				'post_type'   => 'page',
				'post_status' => 'publish',
			);
			$pages = get_pages( $args );

			$list_of_pages = array();

			// Parse through the objects returned and add the key value pairs to the list_of_pages array
			foreach ( $pages as $page ) {
				$list_of_pages[ $page->post_title ] = $page->ID;
			}

			vc_map( array(
				'name'     => _x( 'Featured Page', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'dropdown',
						'heading'    => _x( 'Page', 'backend', 'vc-elements-pt' ),
						'param_name' => 'page',
						'value'      => $list_of_pages,
					),
					array(
						'type'       => 'dropdown',
						'heading'    => _x( 'Layout', 'backend', 'vc-elements-pt' ),
						'param_name' => 'layout',
						'value'      => array(
							_x( 'With big picture', 'backend', 'vc-elements-pt' ) => 'block',
							_x( 'With small picture, inline', 'backend', 'vc-elements-pt' ) => 'inline',
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => _x( 'Read more text', 'backend', 'vc-elements-pt' ),
						'param_name' => 'read_more_text',
						'value' => _x( 'Read more', 'backend', 'vc-elements-pt' ),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Featured_Page;
}