<?php
/* Tribe Events Calendar support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('little_birdies_tribe_events_theme_setup1')) {
	add_action( 'after_setup_theme', 'little_birdies_tribe_events_theme_setup1', 1 );
	function little_birdies_tribe_events_theme_setup1() {
		add_filter( 'little_birdies_filter_list_sidebars', 'little_birdies_tribe_events_list_sidebars' );
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('little_birdies_tribe_events_theme_setup3')) {
	add_action( 'after_setup_theme', 'little_birdies_tribe_events_theme_setup3', 3 );
	function little_birdies_tribe_events_theme_setup3() {
		if (little_birdies_exists_tribe_events()) {
			little_birdies_storage_merge_array('options', '', array(
				// Section 'Tribe Events' - settings for show pages
				'events' => array(
					"title" => esc_html__('Events', 'little-birdies'),
					"desc" => wp_kses_data( __('Select parameters to display the events pages', 'little-birdies') ),
					"type" => "section"
					),
				'expand_content_events' => array(
					"title" => esc_html__('Expand content', 'little-birdies'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'little-birdies') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_widgets_events' => array(
					"title" => esc_html__('Header widgets', 'little-birdies'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the events pages', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'sidebar_widgets_events' => array(
					"title" => esc_html__('Sidebar widgets', 'little-birdies'),
					"desc" => wp_kses_data( __('Select sidebar to show on the events pages', 'little-birdies') ),
					"std" => 'tribe_events_widgets',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'sidebar_position_events' => array(
					"title" => esc_html__('Sidebar position', 'little-birdies'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the events pages', 'little-birdies') ),
					"refresh" => false,
					"std" => 'left',
					"options" => little_birdies_get_list_sidebars_positions(),
					"type" => "select"
					),
				'widgets_above_page_events' => array(
					"title" => esc_html__('Widgets above the page', 'little-birdies'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_above_content_events' => array(
					"title" => esc_html__('Widgets above the content', 'little-birdies'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_below_content_events' => array(
					"title" => esc_html__('Widgets below the content', 'little-birdies'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_below_page_events' => array(
					"title" => esc_html__('Widgets below the page', 'little-birdies'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'footer_scheme_events' => array(
					"title" => esc_html__('Footer Color Scheme', 'little-birdies'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'little-birdies') ),
					"std" => 'dark',
					"options" => little_birdies_get_list_schemes(true),
					"type" => "select"
					),
				'footer_widgets_events' => array(
					"title" => esc_html__('Footer widgets', 'little-birdies'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'little-birdies') ),
					"std" => 'footer_widgets',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'footer_columns_events' => array(
					"title" => esc_html__('Footer columns', 'little-birdies'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'little-birdies') ),
					"dependency" => array(
						'footer_widgets_events' => array('^hide')
					),
					"std" => 0,
					"options" => little_birdies_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_events' => array(
					"title" => esc_html__('Footer fullwide', 'little-birdies'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'little-birdies') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('little_birdies_tribe_events_theme_setup9')) {
	add_action( 'after_setup_theme', 'little_birdies_tribe_events_theme_setup9', 9 );
	function little_birdies_tribe_events_theme_setup9() {
		
		if (little_birdies_exists_tribe_events()) {
			add_action( 'wp_enqueue_scripts', 								'little_birdies_tribe_events_frontend_scripts', 1100 );
			add_filter( 'little_birdies_filter_merge_styles',						'little_birdies_tribe_events_merge_styles' );
			add_filter( 'little_birdies_filter_get_css',							'little_birdies_tribe_events_get_css', 10, 4 );
			add_filter( 'little_birdies_filter_post_type_taxonomy',				'little_birdies_tribe_events_post_type_taxonomy', 10, 2 );
			if (!is_admin()) {
				add_filter( 'little_birdies_filter_detect_blog_mode',				'little_birdies_tribe_events_detect_blog_mode' );
				add_filter( 'little_birdies_filter_get_post_categories', 			'little_birdies_tribe_events_get_post_categories');
				add_filter( 'little_birdies_filter_get_post_date',		 			'little_birdies_tribe_events_get_post_date');
			} else {
				add_action( 'admin_enqueue_scripts',						'little_birdies_tribe_events_admin_scripts' );
			}
		}
		if (is_admin()) {
			add_filter( 'little_birdies_filter_tgmpa_required_plugins',			'little_birdies_tribe_events_tgmpa_required_plugins' );
		}

	}
}



// Check if Tribe Events is installed and activated
if ( !function_exists( 'little_birdies_exists_tribe_events' ) ) {
	function little_birdies_exists_tribe_events() {
		return class_exists( 'Tribe__Events__Main' );
	}
}

// Return true, if current page is any tribe_events page
if ( !function_exists( 'little_birdies_is_tribe_events_page' ) ) {
	function little_birdies_is_tribe_events_page() {
		$rez = false;
		if (little_birdies_exists_tribe_events())
			if (!is_search()) $rez = tribe_is_event() || tribe_is_event_query() || tribe_is_event_category() || tribe_is_event_venue() || tribe_is_event_organizer();
		return $rez;
	}
}

// Detect current blog mode
if ( !function_exists( 'little_birdies_tribe_events_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'little_birdies_filter_detect_blog_mode', 'little_birdies_tribe_events_detect_blog_mode' );
	function little_birdies_tribe_events_detect_blog_mode($mode='') {
		if (little_birdies_is_tribe_events_page())
			$mode = 'events';
		return $mode;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'little_birdies_tribe_events_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'little_birdies_filter_post_type_taxonomy',	'little_birdies_tribe_events_post_type_taxonomy', 10, 2 );
	function little_birdies_tribe_events_post_type_taxonomy($tax='', $post_type='') {
		if (little_birdies_exists_tribe_events() && $post_type == Tribe__Events__Main::POSTTYPE)
			$tax = Tribe__Events__Main::TAXONOMY;
		return $tax;
	}
}

// Show categories of the current event
if ( !function_exists( 'little_birdies_tribe_events_get_post_categories' ) ) {
	//Handler of the add_filter( 'little_birdies_filter_get_post_categories', 		'little_birdies_tribe_events_get_post_categories');
	function little_birdies_tribe_events_get_post_categories($cats='') {
		if (get_post_type()==Tribe__Events__Main::POSTTYPE) {
			$cats = little_birdies_get_post_terms(', ', get_the_ID(), Tribe__Events__Main::TAXONOMY);
		}
		return $cats;
	}
}

// Return date of the current event
if ( !function_exists( 'little_birdies_tribe_events_get_post_date' ) ) {
	//Handler of the add_filter( 'little_birdies_filter_get_post_date',		 		'little_birdies_tribe_events_get_post_date');
	function little_birdies_tribe_events_get_post_date($dt='') {
		if (get_post_type()==Tribe__Events__Main::POSTTYPE) {
			$dt = tribe_get_start_date(null, true, 'Y-m-d');
			$dt = sprintf($dt < date('Y-m-d') 
								? esc_html__('Started on %s', 'little-birdies') 
								: esc_html__('Starting %s', 'little-birdies'),
								date(get_option('date_format'), strtotime($dt)));
		}
		return $dt;
	}
}
	
// Enqueue Tribe Events admin scripts and styles
if ( !function_exists( 'little_birdies_tribe_events_admin_scripts' ) ) {
	//Handler of the add_action( 'admin_enqueue_scripts', 'little_birdies_tribe_events_admin_scripts' );
	function little_birdies_tribe_events_admin_scripts() {
		//Uncomment next line if you want disable custom UI styles from Tribe Events plugin
		//wp_deregister_style('tribe-jquery-ui-theme');
	}
}

// Enqueue Tribe Events custom scripts and styles
if ( !function_exists( 'little_birdies_tribe_events_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'little_birdies_tribe_events_frontend_scripts', 1100 );
	function little_birdies_tribe_events_frontend_scripts() {
		if (little_birdies_is_tribe_events_page()) {
			wp_deregister_style('tribe-events-custom-jquery-styles');
			if (little_birdies_is_on(little_birdies_get_theme_option('debug_mode')) && file_exists(little_birdies_get_file_dir('plugins/the-events-calendar/the-events-calendar.css')))
				wp_enqueue_style( 'little_birdies-the-events-calendar',  little_birdies_get_file_url('plugins/the-events-calendar/the-events-calendar.css'), array(), null );
				wp_enqueue_style( 'little_birdies-the-events-calendar-images',  little_birdies_get_file_url('css/the-events-calendar.css'), array(), null );
		}
	}
}

// Merge custom styles
if ( !function_exists( 'little_birdies_tribe_events_merge_styles' ) ) {
	//Handler of the add_filter('little_birdies_filter_merge_styles', 'little_birdies_tribe_events_merge_styles');
	function little_birdies_tribe_events_merge_styles($list) {
		$list[] = 'plugins/the-events-calendar/the-events-calendar.css';
		$list[] = 'css/the-events-calendar.css';
		return $list;
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'little_birdies_tribe_events_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('little_birdies_filter_tgmpa_required_plugins',	'little_birdies_tribe_events_tgmpa_required_plugins');
	function little_birdies_tribe_events_tgmpa_required_plugins($list=array()) {
		if (in_array('the-events-calendar', little_birdies_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> esc_html__('Tribe Events Calendar', 'little-birdies'),
					'slug' 		=> 'the-events-calendar',
					'required' 	=> false
				);
		return $list;
	}
}



// Add Tribe Events specific items into lists
//------------------------------------------------------------------------

// Add sidebar
if ( !function_exists( 'little_birdies_tribe_events_list_sidebars' ) ) {
	//Handler of the add_filter( 'little_birdies_filter_list_sidebars', 'little_birdies_tribe_events_list_sidebars' );
	function little_birdies_tribe_events_list_sidebars($list=array()) {
		$list['tribe_events_widgets'] = array(
											'name' => esc_html__('Tribe Events Widgets', 'little-birdies'),
											'description' => esc_html__('Widgets to be shown on the Tribe Events pages', 'little-birdies')
											);
		return $list;
	}
}



// Add Tribe Events specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'little_birdies_tribe_events_get_css' ) ) {
	//Handler of the add_filter( 'little_birdies_filter_get_css', 'little_birdies_tribe_events_get_css', 10, 4 );
	function little_birdies_tribe_events_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
			
.tribe-events-list .tribe-events-list-event-title {
	{$fonts['h3_font-family']}
}

.tribe-events-list .tribe-events-list-separator-month,
.tribe-events-calendar thead th,
.tribe-events-schedule, .tribe-events-schedule h2,
.tribe-events-read-more,
#tribe-events .tribe-events-button, .tribe-events-button, .tribe-events-cal-links a, .tribe-events-sub-nav li a,
#tribe-bar-form button, #tribe-bar-form a {
	{$fonts['h5_font-family']}
}
#tribe-bar-form input, #tribe-events-content.tribe-events-month,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title,
#tribe-mobile-container .type-tribe_events,
.tribe-events-list-widget ol li .tribe-event-title {
	{$fonts['p_font-family']}
}
.tribe-events-loop .tribe-event-schedule-details,
.single-tribe_events #tribe-events-content .tribe-events-event-meta dt,
#tribe-mobile-container .type-tribe_events .tribe-event-date-start {
	{$fonts['info_font-family']};
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Buttons */
#tribe-bar-form .tribe-bar-submit input[type="submit"],
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"],
#tribe-events .tribe-events-button,
.tribe-events-button,
.tribe-events-cal-links a,
.tribe-events-sub-nav li a {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
#tribe-bar-form .tribe-bar-submit input[type="submit"]:hover,
#tribe-bar-form .tribe-bar-submit input[type="submit"]:focus,
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:focus,
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:focus,
#tribe-events .tribe-events-button:hover,
.tribe-events-button:hover,
.tribe-events-cal-links a:hover,
.tribe-events-sub-nav li a:hover {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}

/* Filters bar */
#tribe-bar-form {
	color: {$colors['text_dark']};
}
#tribe-bar-form input[type="text"] {
	color: {$colors['text']};
	border-color: {$colors['text']};
}
#tribe-bar-form #tribe-bar-views label {
    color: {$colors['text_link']};
}
#tribe-bar-views li.tribe-bar-views-option a,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a {
	color: {$colors['inverse_link']};
	background: {$colors['text_link']};
}
#tribe-bar-views li.tribe-bar-views-option a:hover,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover {
	color: {$colors['bg_color']};
	background: {$colors['text_dark']};
}
.datepicker thead tr:first-child th:hover, .datepicker tfoot tr th:hover {
	color: {$colors['text_link']};
	background: {$colors['bg_color_0']};
}
#tribe-events-bar {
    background: {$colors['alter_bg_color']};
}

/* Content */
.tribe-events-calendar thead th {
	color: {$colors['text_dark']};
	background: {$colors['bg_color']} !important;
	border-color: {$colors['alter_bg_color']} !important;
}
.tribe-events-calendar thead th + th:before {
	background: {$colors['bg_color']};
}
#tribe-events-content .tribe-events-calendar td {
	border-color: {$colors['bd_color']} !important;
}
.tribe-events-calendar td div[id*="tribe-events-daynum-"],
.tribe-events-calendar td div[id*="tribe-events-daynum-"] > a {
	color: {$colors['text']};
	border-color: {$colors['alter_bg_color']};
	background: {$colors['alter_bg_color']};
}
.tribe-events-calendar td.tribe-events-has-events div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-has-events div[id*="tribe-events-daynum-"] > a {
	color: {$colors['bg_color']};
	border-color: {$colors['alter_light']};
	background: {$colors['alter_light']};
}
.tribe-events-calendar td.tribe-events-has-events:hover div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-has-events:hover div[id*="tribe-events-daynum-"] > a {
	color: {$colors['bg_color']};
	border-color: {$colors['text_link']};
	background: {$colors['text_link']};
}
.tribe-events-calendar td.tribe-events-othermonth {
	color: {$colors['alter_light']} !important;
	background: {$colors['bg_color_0']} !important;
	border-color: {$colors['alter_bg_color']} !important;
}
.tribe-events-calendar td.tribe-events-othermonth div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-othermonth div[id*="tribe-events-daynum-"] > a {
	color: {$colors['alter_light']} !important;
	background: {$colors['bg_color_0']} !important;
	border-color: {$colors['alter_bg_color']} !important;
}
.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"], .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a {
	color: {$colors['text']};
	background: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bg_color']};
}
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a {
		color: {$colors['text_link']};
	background: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bg_color']};
}
.tribe-events-calendar .tribe-events-has-events:after {
	background-color: {$colors['text']};
}
.tribe-events-calendar .mobile-active.tribe-events-has-events:after {
	background-color: {$colors['bg_color']};
}
#tribe-events-content .tribe-events-calendar td,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a {
	color: {$colors['text']};
}
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a:hover {
	color: {$colors['text_dark']};
}
#tribe-events-content .tribe-events-calendar td.mobile-active,
#tribe-events-content .tribe-events-calendar td.mobile-active:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
#tribe-events-content .tribe-events-calendar td.mobile-active div[id*="tribe-events-daynum-"] {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.single-tribe_events .tribe-events-single-section {
    background-color: {$colors['alter_bg_color']};
}
.single-tribe_events .tribe-events-single-section.secondary {
    background-color: {$colors['alter_hover']};
    color: {$colors['bg_color']};
}
.single-tribe_events .tribe-events-single-section.secondary .tribe-events-meta-group .tribe-events-single-section-title {
    color: {$colors['bg_color']};
}
.tribe-events-read-more,
.tribe-events-widget-link a {
    color: {$colors['inverse_text']} !important;
}
#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active div[id*="tribe-events-daynum-"] a,
.tribe-events-calendar .mobile-active div[id*="tribe-events-daynum-"] a {
	background-color: transparent;
	color: {$colors['bg_color']};
}
.single-tribe_events #tribe-events-content .tribe-events-event-meta dt,
.tribe-events-list-widget ol li .tribe-event-duration:before,
.tribe-events-list-widget ol li .tribe-event-title a {
    color: {$colors['text_dark']};
}
.tribe-events-event-meta .tribe-event-schedule-details,
.tribe-events-list-widget ol li .tribe-event-duration,
.tribe-events-list-widget ol li .tribe-event-title a:hover {
    color: {$colors['text_link']};
}
/* Tooltip */
.recurring-info-tooltip,
.tribe-events-calendar .tribe-events-tooltip,
.tribe-events-week .tribe-events-tooltip,
.tribe-events-tooltip .tribe-events-arrow {
	color: {$colors['text']};
	background: {$colors['alter_bg_color']};
}
#tribe-events-content .tribe-events-tooltip h4 { 
	color: {$colors['bg_color']};
	background: {$colors['text_dark']};
}
.tribe-events-tooltip .tribe-event-duration {
	color: {$colors['inverse_light']};
}

/* Events list */
.tribe-events-list-separator-month {
	color: {$colors['text_dark']};
}
.tribe-events-list-separator-month:after {
	border-color: {$colors['bd_color']};
}
.tribe-events-list .type-tribe_events + .type-tribe_events {
	border-color: {$colors['bd_color']};
}
.tribe-events-list .tribe-events-event-cost span {
	color: {$colors['bg_color']};
	border-color: {$colors['text_dark']};
	background: {$colors['text_dark']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta a {
	color: {$colors['alter_link']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta a:hover {
	color: {$colors['alter_hover']};
}
.tribe-mobile .tribe-events-list .tribe-events-venue-details {
	border-color: {$colors['alter_bd_color']};
}

/* Events day */
.tribe-events-day .tribe-events-day-time-slot h5 {
	color: {$colors['bg_color']};
	background: {$colors['text_dark']};
}

/* Single Event */
.single-tribe_events .tribe-events-single-section {
	border-color: {$colors['bd_color']};
}
.single-tribe_events .tribe-events-venue-map {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_hover']};
	background: {$colors['alter_bg_hover']};
}
.single-tribe_events .tribe-events-schedule .tribe-events-cost {
	color: {$colors['text_dark']};
}


CSS;
		}
		
		return $css;
	}
}
?>