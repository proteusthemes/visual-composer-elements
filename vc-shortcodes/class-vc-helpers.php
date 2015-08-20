<?php

/**
 * Static helper functions for the Visual Composer elements
 */

if ( ! class_exists( 'PT_VC_Helper_Functions' ) ) {
	class PT_VC_Helper_Functions {

		/**
		 * Convert a Visual Composer nested child element data into an array
		 * @param string $child_shortcode_content the nested child elements shortcodes
		 * @return array
		 */
		static function get_child_elements_data( $child_shortcode_content ) {

			// Convert the shortcode to the actual content
			$content = do_shortcode( shortcode_unautop( $child_shortcode_content ) );

			$json_array = explode( PHP_EOL, $content );

			// Remove the first element of the json_array since it will be always empty
			array_shift( $json_array );

			// Create a valid JSON
			$json = '[' . implode( ',' , $json_array ) . ']';

			// return an associative array or the data
			return json_decode( $json, true );
		}
	}
}