<?php

/*
 * Register custom param types for Visual Composer shortcodes
 */

if ( ! class_exists( 'PT_VC_Custom_Param_Types' ) ) {
	class PT_VC_Custom_Param_Types {

		// FontAwesome icons for brochure box shortcode
		private $fa_click_icons_brochure_box;

		// Initialization of the param types
		public function __construct() {
			$this->fa_click_icons_brochure_box = array(
			 'fa-file-o',
			 'fa-file-pdf-o',
			 'fa-file-word-o',
			 'fa-file-text-o',
			 'fa-file-image-o',
			 'fa-file-powerpoint-o',
			 'fa-file-excel-o',
			 'fa-file-audio-o',
			 'fa-file-video-o',
			 'fa-file-archive-o',
			 'fa-file-code-o',
			 'fa-save',
			 'fa-download',
			 'fa-print',
			 'fa-info-circle',
			 'fa-question-circle',
			 'fa-cog',
			 'fa-link',
			);

			// Register custom param types
			add_shortcode_param( 'upload_file', array( $this, 'upload_file' ) );
			add_shortcode_param( 'select_fa_icon_bb', array( $this, 'select_fa_icon_bb' ) );
			add_shortcode_param( 'input_number', array( $this, 'input_number' ) );
			add_shortcode_param( 'lined_textarea', array( $this, 'lined_textarea' ) );
		}

		// Function for registering the upload_file custom param type
		function upload_file( $settings, $value ) {
			ob_start();
			?>

			<div class="select_fa_icon_bb_param_block">
				<input name="<?php echo esc_attr( $settings['param_name'] ); ?>" class="wpb_vc_param_value wpb-textinput <?php echo esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ); ?>_field" id="<?php echo esc_attr( $settings['param_name'] ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
				<input type="button" onclick="ProteusWidgetsUploader.fileUploader.openFileFrame( '<?php echo esc_attr( $settings['param_name'] ); ?>' );" class="upload-brochure-file button button-secondary" value="<?php _ex( 'Upload file', 'backend', 'vc-elements-pt' ); ?>" />
			</div>

			<?php
			return ob_get_clean();
		}

		// Function for registering the select_fa_icon_bb custom param type
		function select_fa_icon_bb( $settings, $value ) {
			ob_start();
			?>

			<div class="select_fa_icon_bb_param_block">
				<small><?php printf( __( 'Click on the icon below or manually select from the %s website', 'vc-elements-pt' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>' ); ?> </small>
				<input name="<?php echo esc_attr( $settings['param_name'] ); ?>" class="wpb_vc_param_value wpb-textinput js-icon-input <?php echo esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ); ?>_field" id="<?php echo esc_attr( $settings['param_name'] ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
				<br>
				<br>
			<?php
			foreach ( $this->fa_click_icons_brochure_box as $icon ) :
			?>
				<a class="js-selectable-icon  icon-widget" href="#" data-iconname="<?php echo esc_attr( $icon ); ?>"><i class="fa fa-lg <?php echo esc_attr( $icon ); ?>"></i></a>
			<?php
			endforeach;
			?>
			</div>

			<?php
			return ob_get_clean();
		}

		// Function for registering the input_number custom param type
		function input_number( $settings, $value ) {
			ob_start();
			?>

			<div class="input_number_param_block">
				<input name="<?php echo esc_attr( $settings['param_name'] ); ?>" class="wpb_vc_param_value wpb-textinput <?php echo esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ); ?>_field" type="number" min="<?php echo esc_attr( $settings['min'] ); ?>" max="<?php echo esc_attr( $settings['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
			</div>

			<?php
			return ob_get_clean();
		}


		function lined_textarea( $settings, $value ) {
			$value = str_replace( ',', PHP_EOL, $value );
			ob_start();
			?>

			<textarea rows="<?php echo esc_attr( $settings['rows'] ); ?>" name="<?php echo esc_attr( $settings['param_name'] ); ?>" class="wpb_vc_param_value wpb-textarea <?php echo esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ); ?>"><?php echo esc_textarea( $value ); ?></textarea>

			<?php
			return ob_get_clean();
		}
	}

	new PT_VC_Custom_Param_Types;
}