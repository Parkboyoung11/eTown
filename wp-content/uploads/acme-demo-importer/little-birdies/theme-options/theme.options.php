<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

// -----------------------------------------------------------------
// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
// -- Internal theme settings
// -----------------------------------------------------------------
little_birdies_storage_set('settings', array(
	
	'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
											// child - duplicate theme options from the main theme to the child-theme only
	
	'custom_sidebars'			=> 8,							// How many custom sidebars will be registered (in addition to theme preset sidebars): 0 - 10

	'ajax_views_counter'		=> true,						// Use AJAX for increment posts counter (if cache plugins used) 
																// or increment posts counter then loading page (without cache plugin)
	'disable_jquery_ui'			=> false,						// Prevent loading custom jQuery UI libraries in the third-party plugins

	'max_load_fonts'			=> 3,							// Max fonts number to load from Google fonts or from uploaded fonts

	'use_mediaelements'			=> true,						// Load script "Media Elements" to play video and audio

	'max_excerpt_length'		=> 45,							// Max words number for the excerpt in the blog style 'Excerpt'.
																// For style 'Classic' - get half from this value
	'message_maxlength'			=> 1000							// Max length of the message from contact form
	
));



// -----------------------------------------------------------------
// -- Theme fonts (Google and/or custom fonts)
// -----------------------------------------------------------------

// Fonts to load when theme start
// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
little_birdies_storage_set('load_fonts', array(
	// Google font
	array(
		'name'	 => 'Dosis',
		'family' => 'sans-serif',
		'styles' => '400,500,600,700,800'		// Parameter 'style' used only for the Google fonts
		)
));

// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
little_birdies_storage_set('load_fonts_subset', 'latin,latin-ext');

// Settings of the main tags
little_birdies_storage_set('theme_fonts', array(
	'p' => array(
		'title'				=> esc_html__('Main text', 'little-birdies'),
		'description'		=> esc_html__('Font settings of the main text of the site', 'little-birdies'),
		'font-family'		=> 'Dosis, sans-serif',
		'font-size' 		=> '1rem',
		'font-weight'		=> '500',
		'font-style'		=> 'normal',
		'line-height'		=> '1.667em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '',
		'margin-top'		=> '0em',
		'margin-bottom'		=> '1.35em'
		),
	'h1' => array(
		'title'				=> esc_html__('Heading 1', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '4.4444em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '0.88em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '1.79em',
		'margin-bottom'		=> '0.3em'
		),
	'h2' => array(
		'title'				=> esc_html__('Heading 2', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '2.778em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.09em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '2.32em',
		'margin-bottom'		=> '0.33em'
		),
	'h3' => array(
		'title'				=> esc_html__('Heading 3', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '2.5em',
		'font-weight'		=> '600',
		'font-style'		=> 'normal',
		'line-height'		=> '1.2em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '2.04em',
		'margin-bottom'		=> '0.4em'
		),
	'h4' => array(
		'title'				=> esc_html__('Heading 4', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '1.667em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.2em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '2.14em',
		'margin-bottom'		=> '0.5em'
		),
	'h5' => array(
		'title'				=> esc_html__('Heading 5', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '1.389em',
		'font-weight'		=> '600',
		'font-style'		=> 'normal',
		'line-height'		=> '1.2em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '1.45em',
		'margin-bottom'		=> '0.5em'
		),
	'h6' => array(
		'title'				=> esc_html__('Heading 6', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '1.278em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.1em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '1.5176em',
		'margin-bottom'		=> '0.53em'
		),
	'logo' => array(
		'title'				=> esc_html__('Logo text', 'little-birdies'),
		'description'		=> esc_html__('Font settings of the text case of the logo', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '1.8em',
		'font-weight'		=> '400',
		'font-style'		=> 'normal',
		'line-height'		=> '1.25em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '1px'
		),
	'button' => array(
		'title'				=> esc_html__('Buttons', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '0.944em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.5em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.4px'
		),
	'input' => array(
		'title'				=> esc_html__('Input fields', 'little-birdies'),
		'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '1em',
		'font-weight'		=> '500',
		'font-style'		=> 'normal',
		'line-height'		=> '1.2em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0px'
		),
	'info' => array(
		'title'				=> esc_html__('Post meta', 'little-birdies'),
		'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '1em',
		'font-weight'		=> '500',
		'font-style'		=> 'normal',
		'line-height'		=> '1.287em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0px',
		'margin-top'		=> '0.4em',
		'margin-bottom'		=> ''
		),
	'menu' => array(
		'title'				=> esc_html__('Main menu', 'little-birdies'),
		'description'		=> esc_html__('Font settings of the main menu items', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '1.056em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.5em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0px'
		),
	'submenu' => array(
		'title'				=> esc_html__('Dropdown menu', 'little-birdies'),
		'description'		=> esc_html__('Font settings of the dropdown menu items', 'little-birdies'),
		'font-family'		=> '',
		'font-size' 		=> '16px',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.5em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0px'
		)
));


// -----------------------------------------------------------------
// -- Theme colors for customizer
// -- Attention! Inner scheme must be last in the array below
// -----------------------------------------------------------------
little_birdies_storage_set('schemes', array(

	// Color scheme: 'default'
	'default' => array(
		'title'	 => esc_html__('Default', 'little-birdies'),
		'colors' => array(
			
			// Whole block border and background
			'bg_color'				=> '#ffffff',
			'bd_color'				=> '#e7e7e7',  //

			// Text and links colors
			'text'					=> '#9f9f9f',   //
			'text_light'			=> '#b7b7b7',
			'text_dark'				=> '#343434',   //
			'text_link'				=> '#f15f26',   //  red
			'text_hover'			=> '#aec134',   //  green

			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '#f0efec',   //
			'alter_bg_hover'		=> '#f8f8f6',   //
			'alter_bd_color'		=> '#e8e8e5',   //
			'alter_bd_hover'		=> '#f6f4f0',   //
			'alter_text'			=> '#ff682d',   //hover accent
			'alter_light'			=> '#eec523',   //hover yellow
			'alter_dark'			=> '#787777',   //
			'alter_link'			=> '#ffda48',   //  yellow
			'alter_hover'			=> '#95cceb',   //  blue

			// Input fields (form's fields and textarea)
			'input_bg_color'		=> 'rgba(221,225,229,0.3)',
			'input_bg_hover'		=> 'rgba(221,225,229,0.3)',
			'input_bd_color'		=> 'rgba(221,225,229,0.3)',
			'input_bd_hover'		=> '#e5e5e5',
			'input_text'			=> '#b7b7b7',
			'input_light'			=> '#e5e5e5',
			'input_dark'			=> '#85a411',  //hover green
			
			// Inverse blocks (text and links on accented bg)
			'inverse_text'			=> '#ffffff',   //
			'inverse_light'			=> '#333333',
			'inverse_dark'			=> '#000000',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#1d1d1d',

			// Additional accented colors (if used in the current theme)
			// For example:
			//'accent2'				=> '#faef81'
		
		)
	),

	// Color scheme: 'dark'
	'dark' => array(
		'title'  => esc_html__('Dark', 'little-birdies'),
		'colors' => array(
			
			// Whole block border and background
			'bg_color'				=> '#0e0d12',
			'bd_color'				=> '#1c1b1f',

			// Text and links colors
			'text'					=> '#ffffff',   //
			'text_light'			=> '#5f5f5f',
			'text_dark'				=> '#ffffff',
			'text_link'				=> '#f15f26',   //
			'text_hover'			=> '#aec134',   //

			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '#f0efec',   //
			'alter_bg_hover'		=> '#28272e',
			'alter_bd_color'		=> '#313131',
			'alter_bd_hover'		=> '#3d3d3d',
			'alter_text'			=> '#ffda48',       //
			'alter_light'			=> '#5f5f5f',
			'alter_dark'			=> '#343434',   //
			'alter_link'			=> '#ffda48',   //
			'alter_hover'			=> '#95cceb',   //

			// Input fields (form's fields and textarea)
			'input_bg_color'		=> 'rgba(62,61,66,0.5)',
			'input_bg_hover'		=> 'rgba(62,61,66,0.5)',
			'input_bd_color'		=> 'rgba(62,61,66,0.5)',
			'input_bd_hover'		=> '#353535',
			'input_text'			=> '#b7b7b7',
			'input_light'			=> '#5f5f5f',
			'input_dark'			=> '#ffffff',
			
			// Inverse blocks (text and links on accented bg)
			'inverse_text'			=> '#ffffff',   //
			'inverse_light'			=> '#5f5f5f',
			'inverse_dark'			=> '#000000',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#1d1d1d',
		
			// Additional accented colors (if used in the current theme)
			// For example:
			//'accent2'				=> '#ff6469'

		)
	),
    // Color scheme: 'dark'
    'darks' => array(
        'title'  => esc_html__('Dark Alternative', 'little-birdies'),
        'colors' => array(

            // Whole block border and background
            'bg_color'				=> '#0e0d12',
            'bd_color'				=> '#1c1b1f',

            // Text and links colors
            'text'					=> '#ffffff',   //
            'text_light'			=> '#5f5f5f',
            'text_dark'				=> '#ffffff',
            'text_link'				=> '#ffda48',   //
            'text_hover'			=> '#ffaa5f',

            // Alternative blocks (submenu, buttons, tabs, etc.)
            'alter_bg_color'		=> '#1e1d22',
            'alter_bg_hover'		=> '#28272e',
            'alter_bd_color'		=> '#313131',
            'alter_bd_hover'		=> '#3d3d3d',
            'alter_text'			=> '#ffda48',       //
            'alter_light'			=> '#5f5f5f',
            'alter_dark'			=> '#ffffff',
            'alter_link'			=> '#ffda48',   //
            'alter_hover'			=> '#95cceb',   //

            // Input fields (form's fields and textarea)
            'input_bg_color'		=> 'rgba(62,61,66,0.5)',
            'input_bg_hover'		=> 'rgba(62,61,66,0.5)',
            'input_bd_color'		=> 'rgba(62,61,66,0.5)',
            'input_bd_hover'		=> '#353535',
            'input_text'			=> '#b7b7b7',
            'input_light'			=> '#5f5f5f',
            'input_dark'			=> '#ffffff',

            // Inverse blocks (text and links on accented bg)
            'inverse_text'			=> '#ffffff',   //
            'inverse_light'			=> '#5f5f5f',
            'inverse_dark'			=> '#000000',
            'inverse_link'			=> '#ffffff',
            'inverse_hover'			=> '#1d1d1d',

            // Additional accented colors (if used in the current theme)
            // For example:
            //'accent2'				=> '#ff6469'

        )
    )

));



// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('little_birdies_options_create')) {

	function little_birdies_options_create() {

		little_birdies_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'little-birdies'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'little-birdies') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'little-birdies') ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'little-birdies'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'little-birdies'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'little-birdies'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => 1,
				"type" => "checkbox"
				),
            'show_page_title' => array(
                "title" => esc_html__('Show Page Title', 'little-birdies'),
                "desc" => wp_kses_data( __('Do you want to show page title area (page/post/category title and breadcrumbs)?', 'little-birdies') ),
                "override" => array(
                    'mode' => 'page',
                    'section' => esc_html__('Header', 'little-birdies')
                ),
                "std" => 1,
                "type" => "checkbox"
            ),
			'header_style' => array(
				"title" => esc_html__('Header style', 'little-birdies'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => 'header-default',
				"options" => apply_filters('little_birdies_filter_list_header_styles', array(
					'header-default' => esc_html__('Default Header',	'little-birdies')
				)),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'little-birdies'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => 'default',
				"options" => array(
					'default' => esc_html__('Default','little-birdies'),
					'over' => esc_html__('Over',	'little-birdies'),
					'under' => esc_html__('Under',	'little-birdies')
				),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'little-birdies'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'little-birdies') ),
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'little-birdies'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"dependency" => array(
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => little_birdies_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'little-birdies'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => 'inherit',
				"options" => little_birdies_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'little-birdies'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'little-birdies') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'little-birdies'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'little-birdies'),
					'left'	=> esc_html__('Left',	'little-birdies'),
					'right'	=> esc_html__('Right',	'little-birdies')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'little-birdies'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => 'inherit',
				"options" => little_birdies_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'little-birdies'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'little-birdies') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'little-birdies'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'little-birdies') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'little-birdies'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'little-birdies') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'little-birdies'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'little-birdies') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'little-birdies') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'little-birdies') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'little-birdies') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'little-birdies') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'little-birdies') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'little-birdies') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'little-birdies'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'little-birdies') ),
				"std" => 0,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'little-birdies'),
				"desc" => wp_kses_data( __('Options for the content area', 'little-birdies') ),
				"type" => "section",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'little-birdies'),
				"desc" => wp_kses_data( __('Select width of the body content', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'little-birdies'),
					'wide'		=> esc_html__('Wide',		'little-birdies'),
					'fullwide'	=> esc_html__('Fullwide',	'little-birdies'),
					'fullscreen'=> esc_html__('Fullscreen',	'little-birdies')
				),
				"type" => "select"
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'little-birdies'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"std" => 'default',
				"options" => little_birdies_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'little-birdies'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'little-birdies'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'little-birdies'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'little-birdies') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'little-birdies') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"std" => '',
				"type" => "image"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'little-birdies') ),
				"std" => '',
				"type" => "image"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'little-birdies'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'little-birdies')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Color Scheme', 'little-birdies'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'little-birdies')
				),
				"std" => 'side',
				"options" => little_birdies_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'little-birdies'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'little-birdies')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => little_birdies_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets above the page', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'little-birdies')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'little-birdies')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'little-birdies')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets below the page', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'little-birdies')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'little-birdies'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number for the site footer', 'little-birdies') ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'little-birdies'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'little-birdies')
				),
				"std" => 'footer-default',
				"options" => apply_filters('little_birdies_filter_list_footer_styles', array(
					'footer-default' => esc_html__('Default Footer',	'little-birdies')
				)),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'little-birdies'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'little-birdies')
				),
				"std" => 'dark',
				"options" => little_birdies_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'little-birdies'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'little-birdies')
				),
				"std" => 'footer_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'little-birdies'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'little-birdies')
				),
				"dependency" => array(
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => little_birdies_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'little-birdies'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'little-birdies') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'little-birdies')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'little-birdies'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'little-birdies') ),
				'refresh' => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'little-birdies') ),
				"dependency" => array(
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'little-birdies'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'little-birdies') ),
				"dependency" => array(
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'little-birdies'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'little-birdies') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'little-birdies'),
				"desc" => wp_kses_data( __('Copyright text in the footer', 'little-birdies') ),
				"std" => esc_html__('ThemeREX &copy; {Y}. All rights reserved. Terms of use and Privacy Policy', 'little-birdies'),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'little-birdies'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'little-birdies') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'little-birdies'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'little-birdies') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'little-birdies'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'little-birdies') ),
				"std" => 'excerpt',
				"options" => little_birdies_get_list_blog_styles(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'little-birdies'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'little-birdies') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'little-birdies'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'little-birdies') ),
				"std" => 'header_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'little-birdies'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'little-birdies') ),
				"std" => 'sidebar_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'little-birdies'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'little-birdies') ),
				"refresh" => false,
				"std" => 'right',
				"options" => little_birdies_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'little-birdies'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'little-birdies') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'little-birdies'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'little-birdies') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'little-birdies'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => 'excerpt',
				"options" => little_birdies_get_list_blog_styles(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'little-birdies'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'little-birdies') ),
				"std" => 2,
				"options" => little_birdies_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'little-birdies'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => little_birdies_get_list_posts_types(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'little-birdies'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => little_birdies_array_merge(array(0 => esc_html__('- Select category -', 'little-birdies')), little_birdies_get_list_categories()),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'little-birdies'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"hidden" => true,
				"std" => '10',
				"type" => "text"
				),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'little-birdies'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"std" => "links",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'little-birdies'),
					'links'	=> esc_html__("Older/Newest", 'little-birdies'),
					'more'	=> esc_html__("Load more", 'little-birdies'),
					'infinite' => esc_html__("Infinite scroll", 'little-birdies')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'little-birdies'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'little-birdies'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'little-birdies') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'little-birdies'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'little-birdies') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'little-birdies'),
					'fullpost'	=> esc_html__('Full post',	'little-birdies')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'little-birdies'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'little-birdies') ),
				"std" => 5,
				"type" => "text"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'little-birdies'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post?', 'little-birdies') ),
				"std" => 2,
				"options" => little_birdies_get_list_range(2,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'little-birdies'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'little-birdies') ),
				"std" => 2,
				"options" => little_birdies_get_list_styles(1,2),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'little-birdies'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'little-birdies')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => "none",
				"options" => little_birdies_get_list_animations_in(),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'little-birdies'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'little-birdies'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'little-birdies') ),
				"std" => 'sidebar_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'little-birdies'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'little-birdies') ),
				"refresh" => false,
				"std" => 'right',
				"options" => little_birdies_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'little-birdies'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'little-birdies') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'little-birdies')), little_birdies_get_list_sidebars()),
				"type" => "select"
				),
			
		
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'little-birdies'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'little-birdies') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'little-birdies') ),
				"priority" => 1000,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'little-birdies'),
				"desc" => '',
				"std" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'little-birdies'),
					"advanced" => esc_html__("Advanced", 'little-birdies')
				),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme_editor' => array(
				"title" => esc_html__('Color Scheme', 'little-birdies'),
				"desc" => wp_kses_data( __('Select color scheme to edit colors', 'little-birdies') ),
				"std" => 'default',
				"options" => little_birdies_get_list_schemes(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'little-birdies'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'little-birdies'),
				"std" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_single' => array(
				"title" => esc_html__('Colors for single post/page', 'little-birdies'),
				"desc" => wp_kses_data( __('Specify colors for single post/page (not for alter blocks)', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'little-birdies'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'little-birdies'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'little-birdies') ),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'little-birdies'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'little-birdies') ),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'little-birdies'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'little-birdies'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'little-birdies'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'little-birdies'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'little-birdies'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'little-birdies'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'little-birdies'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'little-birdies'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'little-birdies'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the active field', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'little-birdies'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'little-birdies'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'little-birdies') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$little_birdies_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'little-birdies'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'little-birdies') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'little-birdies')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'little-birdies'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'little-birdies') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'little-birdies')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'little-birdies'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'little-birdies'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'little-birdies') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'little-birdies') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'little-birdies'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'little-birdies') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'little-birdies') ),
				"refresh" => false,
				"std" => '$little_birdies_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=little_birdies_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'little-birdies'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'little-birdies'),
				"desc" => '',
				"refresh" => false,
				"std" => '$little_birdies_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'little-birdies'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'little-birdies') )
							: '',
				"refresh" => false,
				"std" => '$little_birdies_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'little-birdies'),
					'serif' => esc_html__('serif', 'little-birdies'),
					'sans-serif' => esc_html__('sans-serif', 'little-birdies'),
					'monospace' => esc_html__('monospace', 'little-birdies'),
					'cursive' => esc_html__('cursive', 'little-birdies'),
					'fantasy' => esc_html__('fantasy', 'little-birdies')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'little-birdies'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'little-birdies') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'little-birdies') )
							: '',
				"refresh" => false,
				"std" => '$little_birdies_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = little_birdies_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'little-birdies'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'little-birdies'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = little_birdies_get_list_load_fonts(true);
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'little-birdies'),
						'100' => esc_html__('100 (Light)', 'little-birdies'), 
						'200' => esc_html__('200 (Light)', 'little-birdies'), 
						'300' => esc_html__('300 (Thin)',  'little-birdies'),
						'400' => esc_html__('400 (Normal)', 'little-birdies'),
						'500' => esc_html__('500 (Semibold)', 'little-birdies'),
						'600' => esc_html__('600 (Semibold)', 'little-birdies'),
						'700' => esc_html__('700 (Bold)', 'little-birdies'),
						'800' => esc_html__('800 (Black)', 'little-birdies'),
						'900' => esc_html__('900 (Black)', 'little-birdies')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'little-birdies'),
						'normal' => esc_html__('Normal', 'little-birdies'), 
						'italic' => esc_html__('Italic', 'little-birdies')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'little-birdies'),
						'none' => esc_html__('None', 'little-birdies'), 
						'underline' => esc_html__('Underline', 'little-birdies'),
						'overline' => esc_html__('Overline', 'little-birdies'),
						'line-through' => esc_html__('Line-through', 'little-birdies')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'little-birdies'),
						'none' => esc_html__('None', 'little-birdies'), 
						'uppercase' => esc_html__('Uppercase', 'little-birdies'),
						'lowercase' => esc_html__('Lowercase', 'little-birdies'),
						'capitalize' => esc_html__('Capitalize', 'little-birdies')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$little_birdies_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		little_birdies_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			little_birdies_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'little-birdies'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'little-birdies') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'little-birdies')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('little_birdies_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'little_birdies_options_theme_setup2', 2 );
	function little_birdies_options_theme_setup2() {
		little_birdies_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('little_birdies_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'little_birdies_options_theme_setup5', 5 );
	function little_birdies_options_theme_setup5() {
		little_birdies_storage_set('options_reloaded', false);
		little_birdies_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('little_birdies_load_custom_options')) {
		add_action( 'wp_loaded', 'little_birdies_load_custom_options' );
		function little_birdies_load_custom_options() {
			if (!little_birdies_storage_get('options_reloaded')) {
				little_birdies_storage_set('options_reloaded', true);
				little_birdies_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('little_birdies_load_theme_options') ) {
	function little_birdies_load_theme_options() {
		$options = little_birdies_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$little_birdies_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = $_GET[$k];
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				little_birdies_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			little_birdies_customizer_save_css();
		} else {
			do_action('little_birdies_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('little_birdies_override_theme_options') ) {
	add_action( 'wp', 'little_birdies_override_theme_options', 1 );
	function little_birdies_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			little_birdies_storage_set('blog_archive', true);
			little_birdies_storage_set('blog_template', get_the_ID());
		}
		little_birdies_storage_set('blog_mode', little_birdies_detect_blog_mode());
		if (is_singular()) {
			little_birdies_storage_set('options_meta', get_post_meta(get_the_ID(), 'little_birdies_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('little_birdies_get_theme_option')) {
	function little_birdies_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!little_birdies_storage_isset('post_options_meta', $post_id))
				little_birdies_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'little_birdies_options', true));
			if (little_birdies_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = little_birdies_storage_get_array('post_options_meta', $post_id, $name);
				if (!little_birdies_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && little_birdies_storage_isset('options')) {
			if ( !little_birdies_storage_isset('options', $name) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						//array_shift($s);
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'little-birdies'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						die();
					} else
						$rez = $defa;
				}
			} else {
				$blog_mode = little_birdies_storage_get('blog_mode');
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = $_REQUEST[$name . '_' . $blog_mode];
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = $_REQUEST[$name];
				// Override option from current page settings (if exists)
				} else if (little_birdies_storage_isset('options_meta', $name) && !little_birdies_is_inherit(little_birdies_storage_get_array('options_meta', $name))) {
					$rez = little_birdies_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && little_birdies_storage_isset('options', $name . '_' . $blog_mode, 'val') && !little_birdies_is_inherit(little_birdies_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = little_birdies_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (little_birdies_storage_isset('options', $name, 'val')) {
					$rez = little_birdies_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('little_birdies_check_theme_option')) {
	function little_birdies_check_theme_option($name) {
		return little_birdies_storage_isset('options', $name);
	}
}

// Get dependencies list from the Theme Options
if ( !function_exists('little_birdies_get_theme_dependencies') ) {
	function little_birdies_get_theme_dependencies() {
		$options = little_birdies_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('little_birdies_get_theme_setting')) {
	function little_birdies_get_theme_setting($name) {
		return little_birdies_storage_isset('settings', $name) ? little_birdies_storage_get_array('settings', $name) : false;
	}
}


// Set theme setting
if ( !function_exists( 'little_birdies_set_theme_setting' ) ) {
	function little_birdies_set_theme_setting($option_name, $value) {
		if (little_birdies_storage_isset('settings', $option_name))
			little_birdies_storage_set_array('settings', $option_name, $value);
	}
}
?>