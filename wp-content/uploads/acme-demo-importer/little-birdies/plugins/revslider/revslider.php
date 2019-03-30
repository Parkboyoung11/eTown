<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('little_birdies_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'little_birdies_revslider_theme_setup9', 9 );
	function little_birdies_revslider_theme_setup9() {
		if (is_admin()) {
			add_filter( 'little_birdies_filter_tgmpa_required_plugins',	'little_birdies_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'little_birdies_exists_revslider' ) ) {
	function little_birdies_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'little_birdies_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('little_birdies_filter_tgmpa_required_plugins',	'little_birdies_revslider_tgmpa_required_plugins');
	function little_birdies_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', little_birdies_storage_get('required_plugins'))) {
			$path = little_birdies_get_file_dir('plugins/revslider/revslider.zip');
			$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'little-birdies'),
					'slug' 		=> 'revslider',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
?>