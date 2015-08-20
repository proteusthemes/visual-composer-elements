<?php

/**
 * Opening Time content element for the Visual Composer editor
 */

if ( ! class_exists( 'PT_VC_Opening_Time' ) ) {
	class PT_VC_Opening_Time extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_opening_time'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'      => __( 'Opening time', 'cargopress-pt' ),
				'days_hours' => 'opened|8:00|16:00,opened|11:00|19:00,opened|8:00|16:00,closed,opened|11:00|19:00,closed,closed',
				'separator'  => ' - ',
				'closed'     => __( 'CLOSED', 'cargopress-pt' ),
				'text_below' => '',
				), $atts );

			$instance = array(
				'title'           => $atts['title'],
				'separator'       => $atts['separator'],
				'closed_text'     => $atts['closed'],
				'additional_info' => $atts['text_below'],
			);

			$days = array( 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun' );

			$lines = explode( PHP_EOL , $atts['days_hours'] );

			for ( $i = 0; $i < 7; $i++ ) {
				$line                                = ! empty( $lines[ $i ] ) ? explode( '|' , $lines[ $i ] ) : '';
				$instance[ $days[ $i ] . '_opened' ] = ( ! empty( $line[0] ) && 'opened' === $line[0] ) ? '1' : '';
				$instance[ $days[ $i ] . '_from' ]   = ! empty( $line[1] ) ? wp_strip_all_tags( $line[1] ) : '';
				$instance[ $days[ $i ] . '_to' ]     = ! empty( $line[2] ) ? wp_strip_all_tags( $line[2] ) : '';
			}

			ob_start();
			the_widget( 'PW_Opening_Time', $instance );
			return ob_get_clean();
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Opening Time', 'cargopress-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Content', 'cargopress-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'params'   => array(
					array(
						'type'       => 'textfield',
						'holder'     => 'div',
						'heading'    => __( 'Title', 'cargopress-pt' ),
						'param_name' => 'title',
						'value'      => __( 'Opening Time', 'cargopress-pt' ),
					),
					array(
						'type'        => 'lined_textarea',
						'heading'     => __( 'Days and Hours', 'cargopress-pt' ),
						'description' => __( 'Enter values for opening times - <em>opened</em> or <em>closed</em>|<em>opening time</em>|<em>closing time</em>. Divide value sets with linebreak "Enter" (Example: opened|8:00|16:00).', 'cargopress-pt' ),
						'param_name'  => 'days_hours',
						'rows'        => '7',
						'value'       => 'opened|8:00|16:00,opened|11:00|19:00,opened|8:00|16:00,closed,opened|11:00|19:00,closed,closed',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Separator between hours', 'cargopress-pt' ),
						'param_name'  => 'separator',
						'value'       => ' - ',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Text used for closed days', 'cargopress-pt' ),
						'param_name'  => 'closed',
						'value'       => __( 'CLOSED', 'cargopress-pt' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Text below the timetable for additional info (for example lunch time)', 'cargopress-pt' ),
						'param_name'  => 'text_below',
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Opening_Time;
}