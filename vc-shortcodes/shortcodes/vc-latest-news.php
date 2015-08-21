<?php

/**
 * Latest News content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Latest_News' ) ) {
	class PT_VC_Latest_News extends PT_VC_Shortcode {

		private $max_post_number;

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_latest_news'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();

			$this->max_post_number = 10;
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'layout'            => 'block',
				'order_number'      => 1,
				'order_number_from' => 1,
				'order_number_to'   => 3,
				'show_more_link'    => '',
				), $atts );

			$instance = array(
				'type'      => $atts['layout'],
				'from'      => absint( $atts['order_number'] ),
				'to'        => absint( $atts['order_number'] ),
				'more_news' => $atts['show_more_link'],
			);

			// If the inline layout is selected then set the from and to variables
			if ( 'inline' === $atts['layout'] ) {
				$instance['from'] = absint( $atts['order_number_from'] );
				$instance['to']   = absint( $atts['order_number_to'] );
			}

			// Bound from and to between 1 and max_post_number
			$instance['from'] = PW_Functions::bound( $instance['from'], 1, $this->max_post_number );
			$instance['to']   = PW_Functions::bound( $instance['to'], 1, $this->max_post_number );

			// to can't be lower than from
			if ( $instance['from'] > $instance['to'] ) {
				$instance['to'] = $instance['from'];
			}

			ob_start();
			the_widget( 'PW_Latest_News', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => _x( 'Latest News', 'backend', 'vc-elements-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => _x( 'Content', 'backend', 'vc-elements-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'dropdown',
						'holder'     => 'div',
						'heading'    => _x( 'Display type', 'backend', 'vc-elements-pt' ),
						'param_name' => 'layout',
						'value'      => array(
							_x( 'Box (one post)', 'backend', 'vc-elements-pt' )          => 'block',
							_x( 'Inline (multiple posts)', 'backend', 'vc-elements-pt' ) => 'inline',
						),
					),
					array(
						'type'        => 'input_number',
						'heading'     => _x( 'Post order number', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Input a number. Min: 1, Max: 10', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'order_number',
						'min'         => 1,
						'max'         => $this->max_post_number,
						'value'       => 1,
						'dependency' => array(
							'element' => 'layout',
							'value'   => array( 'block' )
						),
					),
					array(
						'type'        => 'input_number',
						'heading'     => _x( 'Post order number for the start of the interval', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Input a number. Min: 1, Max: 10', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'order_number_from',
						'min'         => 1,
						'max'         => $this->max_post_number,
						'value'       => 1,
						'dependency' => array(
							'element' => 'layout',
							'value'   => array( 'inline' )
						),
					),
					array(
						'type'        => 'input_number',
						'heading'     => _x( 'Post order number for the end of the interval', 'backend', 'vc-elements-pt' ),
						'description' => _x( 'Input a number. Min: 1, Max: 10', 'backend', 'vc-elements-pt' ),
						'param_name'  => 'order_number_to',
						'min'         => 1,
						'max'         => $this->max_post_number,
						'value'       => 3,
						'dependency' => array(
							'element' => 'layout',
							'value'   => array( 'inline' )
						),
					),
					array(
						'type'       => 'checkbox',
						'heading'    => _x( 'Show more news link', 'backend', 'vc-elements-pt' ),
						'param_name' => 'show_more_link',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Latest_News;
}