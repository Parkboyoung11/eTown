<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('little_birdies_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'little_birdies_cf7_theme_setup9', 9 );
	function little_birdies_cf7_theme_setup9() {
		
		if (little_birdies_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'little_birdies_cf7_frontend_scripts', 1100 );
			add_filter( 'little_birdies_filter_merge_styles',						'little_birdies_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'little_birdies_filter_tgmpa_required_plugins',			'little_birdies_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'little_birdies_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('little_birdies_filter_tgmpa_required_plugins',	'little_birdies_cf7_tgmpa_required_plugins');
	function little_birdies_cf7_tgmpa_required_plugins($list=array()) {
		if (in_array('contact-form-7', little_birdies_storage_get('required_plugins'))) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> esc_html__('Contact Form 7', 'little-birdies'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'little_birdies_exists_cf7' ) ) {
	function little_birdies_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'little_birdies_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'little_birdies_cf7_frontend_scripts', 1100 );
	function little_birdies_cf7_frontend_scripts() {
		if (little_birdies_is_on(little_birdies_get_theme_option('debug_mode')) && file_exists(little_birdies_get_file_dir('plugins/contact-form-7/contact-form-7.css')))
			wp_enqueue_style( 'little_birdies-contact-form-7',  little_birdies_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'little_birdies_cf7_merge_styles' ) ) {
	//Handler of the add_filter('little_birdies_filter_merge_styles', 'little_birdies_cf7_merge_styles');
	function little_birdies_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>