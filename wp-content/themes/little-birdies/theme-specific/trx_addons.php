<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */

if (!function_exists('little_birdies_trx_addons_theme_specific_setup1')) {
	add_action( 'after_setup_theme', 'little_birdies_trx_addons_theme_specific_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'little_birdies_trx_addons_theme_specific_setup1', 8 );
	function little_birdies_trx_addons_theme_specific_setup1() {
		if (little_birdies_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',				'little_birdies_trx_addons_cv_enable');
			add_filter( 'trx_addons_cpt_list',				'little_birdies_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',				'little_birdies_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',			'little_birdies_trx_addons_widgets_list');
		}
	}
}

// CV
if ( !function_exists( 'little_birdies_trx_addons_cv_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_cv_enable', 'little_birdies_trx_addons_cv_enable');
	function little_birdies_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return true;
	}
}

// CPT
if ( !function_exists( 'little_birdies_trx_addons_cpt_list' ) ) {
	//Handler of the add_filter('trx_addons_cpt_list',	'little_birdies_trx_addons_cpt_list');
	function little_birdies_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list
        unset($list['portfolio']);
        unset($list['resume']);
        unset($list['courses']);
        unset($list['dishes']);
        unset($list['certificates']);
		return $list;
	}
}

// Shortcodes
if ( !function_exists( 'little_birdies_trx_addons_sc_list' ) ) {
	//Handler of the add_filter('trx_addons_sc_list',	'little_birdies_trx_addons_sc_list');
	function little_birdies_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php
		return $list;
	}
}

// Widgets
if ( !function_exists( 'little_birdies_trx_addons_widgets_list' ) ) {
	//Handler of the add_filter('trx_addons_widgets_list',	'little_birdies_trx_addons_widgets_list');
	function little_birdies_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php
		return $list;
	}
}


/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('little_birdies_trx_addons_theme_specific_setup3')) {
	add_action( 'after_setup_theme', 'little_birdies_trx_addons_theme_specific_setup3', 3 );
	function little_birdies_trx_addons_theme_specific_setup3() {
		
		// Section 'Courses' - settings to show 'Courses' blog archive and single posts
		if (little_birdies_exists_courses()) {
			little_birdies_storage_merge_array('options', '', array(
				'courses' => array(
					"title" => esc_html__('Courses', 'little-birdies'),
					"desc" => wp_kses_data( __('Select parameters to display the courses pages', 'little-birdies') ),
					"type" => "section"
					),
				'expand_content_courses' => array(
					"title" => esc_html__('Expand content', 'little-birdies'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'little-birdies') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_widgets_courses' => array(
					"title" => esc_html__('Header widgets', 'little-birdies'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the courses pages', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'sidebar_widgets_courses' => array(
					"title" => esc_html__('Sidebar widgets', 'little-birdies'),
					"desc" => wp_kses_data( __('Select sidebar to show on the courses pages', 'little-birdies') ),
					"std" => 'courses_widgets',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'sidebar_position_courses' => array(
					"title" => esc_html__('Sidebar position', 'little-birdies'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the courses pages', 'little-birdies') ),
					"refresh" => false,
					"std" => 'left',
					"options" => little_birdies_get_list_sidebars_positions(),
					"type" => "select"
					),
				'widgets_above_page_courses' => array(
					"title" => esc_html__('Widgets above the page', 'little-birdies'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_above_content_courses' => array(
					"title" => esc_html__('Widgets above the content', 'little-birdies'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_below_content_courses' => array(
					"title" => esc_html__('Widgets below the content', 'little-birdies'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_below_page_courses' => array(
					"title" => esc_html__('Widgets below the page', 'little-birdies'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'little-birdies') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'footer_scheme_courses' => array(
					"title" => esc_html__('Footer Color Scheme', 'little-birdies'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'little-birdies') ),
					"std" => 'dark',
					"options" => little_birdies_get_list_schemes(true),
					"type" => "select"
					),
				'footer_widgets_courses' => array(
					"title" => esc_html__('Footer widgets', 'little-birdies'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'little-birdies') ),
					"std" => 'footer_widgets',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
					"type" => "select"
					),
				'footer_columns_courses' => array(
					"title" => esc_html__('Footer columns', 'little-birdies'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'little-birdies') ),
					"dependency" => array(
						'footer_widgets_courses' => array('^hide')
					),
					"std" => 0,
					"options" => little_birdies_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_courses' => array(
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

// Add mobile menu to the plugin's cached menu list
if ( !function_exists( 'little_birdies_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'little_birdies_trx_addons_menu_cache');
	function little_birdies_trx_addons_menu_cache($list=array()) {
		if (in_array('#menu_main', $list)) $list[] = '#menu_mobile';
		return $list;
	}
}

// Add vars into localize array
if (!function_exists('little_birdies_trx_addons_localize_script')) {
	add_filter( 'little_birdies_filter_localize_script','little_birdies_trx_addons_localize_script' );
	function little_birdies_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = little_birdies_get_scheme_color('alter_link');
		return $arr;
	}
}


// Add theme-specific layouts to the list
if (!function_exists('little_birdies_trx_addons_theme_specific_default_layouts')) {
	add_filter( 'trx_addons_filter_default_layouts',	'little_birdies_trx_addons_theme_specific_default_layouts');
	function little_birdies_trx_addons_theme_specific_default_layouts($default_layouts=array()) {
		require_once 'trx_addons.layouts.php';
		return isset($layouts) && is_array($layouts) && count($layouts) > 0
						? array_merge($default_layouts, $layouts)
						: $default_layouts;
	}
}

// Disable override header image on team pages
if ( !function_exists( 'little_birdies_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'little_birdies_filter_allow_override_header_image', 'little_birdies_trx_addons_allow_override_header_image' );
	function little_birdies_trx_addons_allow_override_header_image($allow) {
		return little_birdies_is_team_page() || little_birdies_is_portfolio_page() ? false : $allow;
	}
}

// Hide sidebar on the team pages
if ( !function_exists( 'little_birdies_trx_addons_sidebar_present' ) ) {
	add_filter( 'little_birdies_filter_sidebar_present', 'little_birdies_trx_addons_sidebar_present' );
	function little_birdies_trx_addons_sidebar_present($present) {
		return little_birdies_is_team_page() || little_birdies_is_portfolio_page() ? false : $present;
	}
}


// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( !function_exists( 'little_birdies_trx_addons_editor_init' ) ) {
	if (is_admin()) add_filter( 'tiny_mce_before_init', 'little_birdies_trx_addons_editor_init', 11);
	function little_birdies_trx_addons_editor_init($opt) {
		if (little_birdies_exists_trx_addons()) {
			// Add style 'Arrow' to the 'List styles'
			// Remove 'false &&' from condition below to add new style to the list
			if (!empty($opt['style_formats'])) {
				$style_formats = json_decode($opt['style_formats'], true);
				if (is_array($style_formats) && count($style_formats)>0 ) {
					foreach ($style_formats as $k=>$v) {

                        if ( $v['title'] == esc_html__('Inline', 'little-birdies') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Accent hovered', 'little-birdies'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_accent_hovered'
                            );
                        }

                        if ( $v['title'] == esc_html__('Inline', 'little-birdies') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Accent background hovered', 'little-birdies'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_accent_bg_hovered'
                            );
                        }

                        if ( $v['title'] == esc_html__('Inline', 'little-birdies') ) {
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Dropcap 3', 'little-birdies'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_dropcap trx_addons_dropcap_style_3'
                            );
                            $style_formats[$k]['items'][] = array(
                                'title' => esc_html__('Dropcap 4', 'little-birdies'),
                                'inline' => 'span',
                                'classes' => 'trx_addons_dropcap trx_addons_dropcap_style_4'
                            );
                        }

						if ( $v['title'] == esc_html__('List styles', 'little-birdies') ) {
							$style_formats[$k]['items'][] = array(
										'title' => esc_html__('Arrow', 'little-birdies'),
										'selector' => 'ul',
										'classes' => 'trx_addons_list trx_addons_list_arrow'
									);
						}
					}
					$opt['style_formats'] = json_encode( $style_formats );		
				}
			}
		}
		return $opt;
	}
}


// Theme-specific thumb sizes
//------------------------------------------------------------------------

// Replace thumb sizes to the theme-specific
if ( !function_exists( 'little_birdies_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'little_birdies_trx_addons_add_thumb_sizes');
	function little_birdies_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// Return theme-specific thumb size instead removed plugin's thumb size
if ( !function_exists( 'little_birdies_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'little_birdies_trx_addons_get_thumb_size');
	function little_birdies_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
                'trx_addons-thumb-serv',
                'trx_addons-thumb-serv-@retina',
                'trx_addons-thumb-team',
                'trx_addons-thumb-team-@retina',
                'trx_addons-thumb-posts',
                'trx_addons-thumb-posts-@retina',
                'trx_addons-thumb-event',
                'trx_addons-thumb-event-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'little_birdies-thumb-huge',
							'little_birdies-thumb-huge-@retina',
							'little_birdies-thumb-big',
							'little_birdies-thumb-big-@retina',
							'little_birdies-thumb-med',
							'little_birdies-thumb-med-@retina',
                                'little_birdies-thumb-serv',
                                'little_birdies-thumb-serv-@retina',
                                'little_birdies-thumb-team',
                                'little_birdies-thumb-team-@retina',
                                'little_birdies-thumb-posts',
                                'little_birdies-thumb-posts-@retina',
                                'little_birdies-thumb-event',
                                'little_birdies-thumb-event-@retina',
							'little_birdies-thumb-tiny',
							'little_birdies-thumb-tiny-@retina',
							'little_birdies-thumb-masonry-big',
							'little_birdies-thumb-masonry-big-@retina',
							'little_birdies-thumb-masonry',
							'little_birdies-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}

// Get thumb size for the team items
if ( !function_exists( 'little_birdies_trx_addons_team_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_team_thumb_size',	'little_birdies_trx_addons_team_thumb_size', 10, 2);
	function little_birdies_trx_addons_team_thumb_size($thumb_size='', $team_type='') {
		return $team_type == 'default' ? little_birdies_get_thumb_size('med') : $thumb_size;
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Return tag for the item's title
if ( !function_exists( 'little_birdies_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'little_birdies_trx_addons_sc_item_title_tag');
	function little_birdies_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'little_birdies_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'little_birdies_trx_addons_sc_item_button_args');
	function little_birdies_trx_addons_sc_item_button_args($args, $sc='') {
		if (false && $sc != 'sc_button') {
			$args['type'] = 'simple';
			$args['icon_type'] = 'fontawesome';
			$args['icon_fontawesome'] = 'icon-down-big';
			$args['icon_position'] = 'top';
		}
		return $args;
	}
}

// Add new types in the shortcodes
if ( !function_exists( 'little_birdies_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'little_birdies_trx_addons_sc_type', 10, 2);
	function little_birdies_trx_addons_sc_type($list, $sc) {
		//if (in_array($sc, array('trx_sc_form')))
		//	$list[esc_html__('Workshop', 'little-birdies')] = 'workshop';
        if($sc == 'trx_sc_button') {
            $list[ esc_html__('Yellow button', 'little-birdies') ] = 'yellow_button';
        }
        if (in_array($sc, array('trx_sc_services'))) {
            $list[esc_html__('Text on hover', 'little-birdies')] = 'servimage';
            $list[esc_html__('Colored', 'little-birdies')] = 'color';
        }
        if (in_array($sc, array('trx_sc_events'))) {
            $list[esc_html__('Classic', 'little-birdies')] = 'classic';
        }
		return $list;
	}
}

// Add new styles to the Google map
if ( !function_exists( 'little_birdies_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles',	'little_birdies_trx_addons_sc_googlemap_styles');
	function little_birdies_trx_addons_sc_googlemap_styles($list) {
		$list[esc_html__('Dark', 'little-birdies')] = 'dark';
        $list[esc_html__('Blue', 'little-birdies')] = 'blue';
		return $list;
	}
}
