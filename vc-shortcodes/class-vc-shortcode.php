<?php

/*
 * Abstract class for Visual Composer Shortcodes
 */

if ( ! class_exists( 'PT_VC_Shortcode' ) ) {
	abstract class PT_VC_Shortcode {

		// Initialization of the shortcode
		public function __construct() {
			add_shortcode( $this->shortcode_name() , array( $this, 'register_shortcode' ) );
			add_action( 'vc_before_init', array( $this, 'vc_map_shortcode' ) );
		}

		/**
		 * Functions that child classes have to implement
		 */

		// Basic shortcode settings
		abstract function shortcode_name();

		// Register the shortcode with WordPress
		public abstract function register_shortcode( $atts, $content = null );

		// Map the shortcode parameters with the Visual Composer editor (Add the shortcode to the "Content elements" list)
		public abstract function vc_map_shortcode();

	}
}