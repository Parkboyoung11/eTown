<?php
/* Visual Composer support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('little_birdies_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'little_birdies_vc_theme_setup9', 9 );
	function little_birdies_vc_theme_setup9() {
		if (little_birdies_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'little_birdies_vc_frontend_scripts', 1100 );
			add_filter( 'little_birdies_filter_merge_styles',						'little_birdies_vc_merge_styles' );
			add_filter( 'little_birdies_filter_merge_scripts',						'little_birdies_vc_merge_scripts' );
			add_filter( 'little_birdies_filter_get_css',							'little_birdies_vc_get_css', 10, 4 );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,					'little_birdies_vc_add_params_classes', 10, 3 );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'little-birdies'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'little-birdies') ),
				"group" => esc_html__('Colors', 'little-birdies'),
				"admin_label" => true,
				"value" => array_flip(little_birdies_get_list_schemes(true)),
				"type" => "dropdown"
			);

			vc_add_param("vc_row", $scheme);
			vc_add_param("vc_row_inner", $scheme);
			vc_add_param("vc_column", $scheme);
			vc_add_param("vc_column_inner", $scheme);
			vc_add_param("vc_column_text", $scheme);

            // Add Narrow style to the Progress bars
            vc_add_param("vc_row", array(
                "param_name" => "back_image",
                "group" => esc_html__('Design Options', 'little-birdies'),
                "heading" => esc_html__("Show background only on desktop", 'little-birdies'),
                "description" => wp_kses_data( __("Show background only on desktop", 'little-birdies') ),
                "std" => 0,
                "value" => array(esc_html__("Show background only on desktop", 'little-birdies') => "1" ),
                "type" => "checkbox"
            ));
			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'little-birdies'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'little-birdies') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'little-birdies') => 'tiny',
					esc_html__('Small', 'little-birdies') => 'small',
					esc_html__('Medium', 'little-birdies') => 'medium',
					esc_html__('Large', 'little-birdies') => 'large',
                    esc_html__('Big', 'little-birdies') => 'biggest',
					esc_html__('Huge', 'little-birdies') => 'huge',
					esc_html__('From the value above', 'little-birdies') => 'none'
				),
				"type" => "dropdown"
			));
			vc_add_param("vc_empty_space", array(
				"param_name" => "hide_on_mobile",
				"heading" => esc_html__("Hide on mobile", 'little-birdies'),
				"description" => wp_kses_data( __("Hide this block on the mobile devices, when the columns are arranged one under another", 'little-birdies') ),
				"admin_label" => true,
				"std" => 0,
				"value" => array(
					esc_html__("Hide on mobile", 'little-birdies') => "1",
					esc_html__("Hide on notebook", 'little-birdies') => "2" 
					),
				"type" => "checkbox"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'little-birdies'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'little-birdies') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'little-birdies') => "1" ),
				"type" => "checkbox"
			));

            vc_add_param("vc_progress_bar", array(
                "param_name" => "very_narrow",
                "heading" => esc_html__("Very Narrow", 'little-birdies'),
                "description" => wp_kses_data( __("Use very narrow style for the progress bar", 'little-birdies') ),
                "std" => 0,
                "value" => array(esc_html__("Very Narrow style", 'little-birdies') => "1" ),
                "type" => "checkbox"
            ));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'little-birdies'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'little-birdies') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'little-birdies') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'little_birdies_filter_tgmpa_required_plugins',		'little_birdies_vc_tgmpa_required_plugins' );
			add_filter( 'vc_iconpicker-type-fontawesome',				'little_birdies_vc_iconpicker_type_fontawesome' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'little_birdies_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('little_birdies_filter_tgmpa_required_plugins',	'little_birdies_vc_tgmpa_required_plugins');
	function little_birdies_vc_tgmpa_required_plugins($list=array()) {
		if (in_array('js_composer', little_birdies_storage_get('required_plugins'))) {
			$path = little_birdies_get_file_dir('plugins/js_composer/js_composer.zip');
			$list[] = array(
					'name' 		=> esc_html__('Visual Composer', 'little-birdies'),
					'slug' 		=> 'js_composer',
					'source'	=> !empty($path) ? $path : 'upload://js_composer.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if Visual Composer installed and activated
if ( !function_exists( 'little_birdies_exists_visual_composer' ) ) {
	function little_birdies_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if Visual Composer in frontend editor mode
if ( !function_exists( 'little_birdies_vc_is_frontend' ) ) {
	function little_birdies_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
		//return function_exists('vc_is_frontend_editor') && vc_is_frontend_editor();
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'little_birdies_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'little_birdies_vc_frontend_scripts', 1100 );
	function little_birdies_vc_frontend_scripts() {
		if (little_birdies_exists_visual_composer()) {
			if (little_birdies_is_on(little_birdies_get_theme_option('debug_mode')) && file_exists(little_birdies_get_file_dir('plugins/js_composer/js_composer.css')))
				wp_enqueue_style( 'little_birdies-js_composer',  little_birdies_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
			if (little_birdies_is_on(little_birdies_get_theme_option('debug_mode')) && file_exists(little_birdies_get_file_dir('plugins/js_composer/js_composer.js')))
				wp_enqueue_script( 'little_birdies-js_composer', little_birdies_get_file_url('plugins/js_composer/js_composer.js'), array('jquery'), null, true );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'little_birdies_vc_merge_styles' ) ) {
	//Handler of the add_filter('little_birdies_filter_merge_styles', 'little_birdies_vc_merge_styles');
	function little_birdies_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Merge custom scripts
if ( !function_exists( 'little_birdies_vc_merge_scripts' ) ) {
	//Handler of the add_filter('little_birdies_filter_merge_scripts', 'little_birdies_vc_merge_scripts');
	function little_birdies_vc_merge_scripts($list) {
		$list[] = 'plugins/js_composer/js_composer.js';
		return $list;
	}
}
	
// Add theme icons into VC iconpicker list
if ( !function_exists( 'little_birdies_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'little_birdies_vc_iconpicker_type_fontawesome' );
	function little_birdies_vc_iconpicker_type_fontawesome($icons) {
		$list = little_birdies_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'little-birdies') => $rez) );
	}
}



// Shortcodes
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'little_birdies_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'little_birdies_vc_add_params_classes', 10, 3 );
	function little_birdies_vc_add_params_classes($classes, $sc, $atts) {
		if (in_array($sc, array('vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'))) {
			if (!empty($atts['scheme']) && !little_birdies_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
            if (in_array($sc, array('vc_row'))) {
                if (!empty($atts['back_image']) && (int) $atts['back_image']==1)
                    $classes .= ($classes ? ' ' : '') . 'vc_row_bg_desktop';
            }
		} else if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !little_birdies_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
			if (!empty($atts['hide_on_mobile'])) {
				if (strpos($atts['hide_on_mobile'], '1')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_mobile';
				if (strpos($atts['hide_on_mobile'], '2')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_notebook';
			}
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
            if (!empty($atts['very_narrow']) && (int) $atts['very_narrow']==1)
                $classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow vc_progress_bar_very_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add VC specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'little_birdies_vc_get_css' ) ) {
	//Handler of the add_filter( 'little_birdies_filter_get_css', 'little_birdies_vc_get_css', 10, 4 );
	function little_birdies_vc_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Row and columns */
.scheme_self.wpb_row,
.scheme_self.wpb_column > .vc_column-inner > .wpb_wrapper{
	color: {$colors['text']};
}
.scheme_self.vc_row.vc_parallax[class*="scheme_"] .vc_parallax-inner:before {
	background-color: {$colors['bg_color_08']};
}

/* Accordion */
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-panel-title {
	color: {$colors['inverse_text']};
	background-color: {$colors['alter_bg_color']};
}
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:before,
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:after {
	border-color: {$colors['inverse_text']};
}
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a {
	color: {$colors['text_dark']};
}
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover ,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover {
	color: {$colors['inverse_text']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel:hover .vc_tta-panel-heading,
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a .vc_tta-controls-icon,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a .vc_tta-controls-icon {
	background-color: {$colors['text_link']};
}
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a .vc_tta-controls-icon:before,
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a .vc_tta-controls-icon:after,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a .vc_tta-controls-icon:before,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a .vc_tta-controls-icon:after {
	border-color: {$colors['inverse_text']};
}
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon,
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon {
	background-color: {$colors['inverse_text']};
}
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon:before,
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon:after,
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:before,
.vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:after,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon:before,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon:after,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:before,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:after {
	border-color: {$colors['text_link']};
}

/* Tabs */
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a {
	color: {$colors['text_dark']};
	background-color: {$colors['alter_bg_color']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a:hover,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab.vc_active > a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}

/* Separator */
.vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['bd_color']};
}

/* Progress bar */
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar {
	background-color: {$colors['alter_bd_hover']};
}
.vc_progress_bar.vc_progress_bar_narrow.vc_progress-bar-color-bar_red .vc_single_bar .vc_bar {
	background-color: {$colors['text_link']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label {
	color: {$colors['text_dark']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units {
	color: {$colors['text_dark']};
}
.vc_color-grey.vc_message_box {
    background-color: {$colors['alter_bg_color']};
    color: {$colors['text_dark']};
}
.vc_color-grey.vc_message_box.vc_message_box_closeable:after,
.vc_color-grey.vc_message_box .vc_message_box-icon {
    color: {$colors['alter_dark']};
}

.vc_color-danger.vc_message_box {
    background-color: {$colors['alter_text']};
    color: {$colors['inverse_text']};
}
.vc_color-danger.vc_message_box.vc_message_box_closeable:after,
.vc_color-danger.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_text']};
}

.vc_color-alert-info.vc_message_box {
    background-color: {$colors['alter_hover']};
    color: {$colors['inverse_text']};
}
.vc_color-alert-info.vc_message_box.vc_message_box_closeable:after,
.vc_color-alert-info.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_text']};
}

.vc_color-alert-success.vc_message_box {
    background-color: {$colors['text_hover']};
    color: {$colors['inverse_text']};
}
.vc_color-alert-success.vc_message_box.vc_message_box_closeable:after,
.vc_color-alert-success.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_text']};
}


CSS;
		}
		
		return $css;
	}
}
?>