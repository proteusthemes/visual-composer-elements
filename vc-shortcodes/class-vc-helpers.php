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
			$content = do_shortcode( shortcode_unautop( $child_shortcode_content ) );
			$items   = array();

			foreach ( preg_split( '/\r\n|\r|\n/', $content ) as $line ) {
				$line = preg_replace( '#^(?:\s|</?p>|<br\s*/?>)+|(?:\s|</?p>|<br\s*/?>)+$#i', '', $line );

				if ( '' === $line ) {
					continue;
				}

				$item = json_decode( $line, true );

				if ( is_array( $item ) ) {
					$items[] = $item;
				}
			}

			return $items;
		}

		/**
		 * Get the icon class from an icon picker value without the first 'fa' part
		 * @param string $value the icon picker value, for example 'fa fa-home'
		 * @return string
		 */
		static function get_icon_class( $value ) {
			$tokens = preg_split( '/\s+/', trim( (string) $value ), -1, PREG_SPLIT_NO_EMPTY );

			if ( count( $tokens ) > 1 ) {
				array_shift( $tokens );
			}

			return $tokens ? $tokens[0] : '';
		}
	}
}