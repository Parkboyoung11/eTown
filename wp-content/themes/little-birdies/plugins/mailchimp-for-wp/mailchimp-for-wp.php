<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('little_birdies_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'little_birdies_mailchimp_theme_setup9', 9 );
	function little_birdies_mailchimp_theme_setup9() {
		if (little_birdies_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'little_birdies_mailchimp_frontend_scripts', 1100 );
			add_filter( 'little_birdies_filter_merge_styles',					'little_birdies_mailchimp_merge_styles');
			add_filter( 'little_birdies_filter_get_css',						'little_birdies_mailchimp_get_css', 10, 4);
		}
		if (is_admin()) {
			add_filter( 'little_birdies_filter_tgmpa_required_plugins',		'little_birdies_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'little_birdies_exists_mailchimp' ) ) {
	function little_birdies_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'little_birdies_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('little_birdies_filter_tgmpa_required_plugins',	'little_birdies_mailchimp_tgmpa_required_plugins');
	function little_birdies_mailchimp_tgmpa_required_plugins($list=array()) {
		if (in_array('mailchimp-for-wp', little_birdies_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'little-birdies'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'little_birdies_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'little_birdies_mailchimp_frontend_scripts', 1100 );
	function little_birdies_mailchimp_frontend_scripts() {
		if (little_birdies_exists_mailchimp()) {
			if (little_birdies_is_on(little_birdies_get_theme_option('debug_mode')) && file_exists(little_birdies_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')))
				wp_enqueue_style( 'little_birdies-mailchimp-for-wp',  little_birdies_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'little_birdies_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'little_birdies_filter_merge_styles', 'little_birdies_mailchimp_merge_styles');
	function little_birdies_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}

// Add css styles into global CSS stylesheet
if (!function_exists('little_birdies_mailchimp_get_css')) {
	//Handler of the add_filter('little_birdies_filter_get_css', 'little_birdies_mailchimp_get_css', 10, 4);
	function little_birdies_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		}
		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS


CSS;
		}

		return $css;
	}
}
?>