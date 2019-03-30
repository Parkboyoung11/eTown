<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

// Theme storage
$LITTLE_BIRDIES_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'contact-form-7',
		'essential-grid',
		'instagram-feed',
		'js_composer',
		'mailchimp-for-wp',
		'revslider',
		'the-events-calendar',
		'vc-extensions-bundle',
		'woocommerce'
		)
);


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('little_birdies_theme_setup1') ) {
	add_action( 'after_setup_theme', 'little_birdies_theme_setup1', 1 );
	function little_birdies_theme_setup1() {
		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'little_birdies_filter_content_width', 1170 );
	}
}

if ( !function_exists('little_birdies_theme_setup') ) {
	add_action( 'after_setup_theme', 'little_birdies_theme_setup' );
	function little_birdies_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('little_birdies_filter_add_thumb_sizes', array(
			'little_birdies-thumb-huge'		=> array(1170, 658, true),
			'little_birdies-thumb-big' 		=> array( 770, 460, true),
			'little_birdies-thumb-med' 		=> array( 370, 208, true),
            'little_birdies-thumb-serv' 		=> array( 370, 258, true),
            'little_birdies-thumb-team' 		=> array( 370, 370, true),
            'little_birdies-thumb-posts' 		=> array( 500, 280, true),
            'little_birdies-thumb-event' 		=> array( 536, 436, true),
			'little_birdies-thumb-tiny' 		=> array(  90,  90, true),
			'little_birdies-thumb-masonry-big' => array( 770,   0, false),		// Only downscale, not crop
			'little_birdies-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = little_birdies_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'little_birdies_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false,
			'video' => true
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// WooCommerce Support
		add_theme_support( 'woocommerce' );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				little_birdies_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			little_birdies_theme_fonts_for_editor()
			)
		);	
		
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'little-birdies', little_birdies_get_folder_dir('languages') );
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'little-birdies'),
			'menu_mobile' => esc_html__('Mobile Menu', 'little-birdies'),
			'menu_footer' => esc_html__('Footer Menu', 'little-birdies')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'little_birdies_excerpt_length' );
		add_filter( 'excerpt_more',							'little_birdies_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'little_birdies_wp_head', 1);
		
		// Add custom inline styles
		add_action('wp_footer',		 						'little_birdies_wp_footer');
		add_action('admin_footer',	 						'little_birdies_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'little_birdies_wp_scripts', 1000);			//priority 1000 - load styles before the plugin's support custom styles (priority 1100)
		add_action('wp_footer',		 						'little_birdies_localize_scripts');
		add_action('wp_enqueue_scripts', 					'little_birdies_wp_scripts_responsive', 2000);	//priority 2000 - load responsive after all other styles
		
		// Add body classes
		add_filter( 'body_class',							'little_birdies_add_body_classes' );

		// Register sidebars
		add_action('widgets_init',							'little_birdies_register_sidebars');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'little_birdies_importer_set_options', 9 );
	}

}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------
if ( !function_exists('little_birdies_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'little_birdies_image_sizes' );
	function little_birdies_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('little_birdies_filter_add_thumb_sizes', array(
			'little_birdies-thumb-huge'		=> esc_html__( 'Fullsize image', 'little-birdies' ),
			'little_birdies-thumb-big'			=> esc_html__( 'Large image', 'little-birdies' ),
			'little_birdies-thumb-med'			=> esc_html__( 'Medium image', 'little-birdies' ),
			'little_birdies-thumb-tiny'		=> esc_html__( 'Small square avatar', 'little-birdies' ),
			'little_birdies-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'little-birdies' ),
			'little_birdies-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'little-birdies' ),
			)
		);
		$mult = little_birdies_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'little-birdies' );
		}
		return $sizes;
	}
}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'little_birdies_wp_scripts' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'little_birdies_wp_scripts', 1000);
	function little_birdies_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = little_birdies_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('little_birdies-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'little_birdies-fontello',  little_birdies_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Merged styles
		if ( little_birdies_is_off(little_birdies_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'little_birdies-styles', little_birdies_get_file_url('css/__styles.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'little_birdies-main', $main_stylesheet, array(), null );

		// Load child stylesheet (if different) after the main stylesheet and fontello icons (important!)
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'little_birdies-child', $child_stylesheet, array('little_birdies-main'), null );
		}

		// Add custom bg image for the body_style == 'boxed'
		if ( little_birdies_get_theme_option('body_style') == 'boxed' && ($bg_image = little_birdies_get_theme_option('boxed_bg_image')) != '' )
			wp_add_inline_style( 'little_birdies-main', '.body_style_boxed { background-image:url('.esc_url($bg_image).') }' );



		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && little_birdies_is_off(little_birdies_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'little_birdies-colors', little_birdies_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'little_birdies-main', little_birdies_customizer_get_css() );

		// Add post nav background
		little_birdies_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( substr(little_birdies_get_theme_option('blog_style'), 0, 7) == 'gallery' || substr(little_birdies_get_theme_option('blog_style'), 0, 9) == 'portfolio' )
			wp_enqueue_script( 'modernizr', little_birdies_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', little_birdies_get_file_url('js/superfish.js'), array('jquery'), null, true );
		
		// Merged scripts
		if ( little_birdies_is_off(little_birdies_get_theme_option('debug_mode')) )
			wp_enqueue_script( 'little_birdies-init', little_birdies_get_file_url('js/__scripts.js'), array('jquery'), null, true );
		else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', little_birdies_get_file_url('js/skip-link-focus-fix.js'), null, true );
			// Background video
			$header_video = little_birdies_get_header_video();
			if (!empty($header_video) && !little_birdies_is_inherit($header_video))
				wp_enqueue_script( 'bideo', little_birdies_get_file_url('js/bideo.js'), array(), null, true );
			// Theme scripts
			wp_enqueue_script( 'little_birdies-utils', little_birdies_get_file_url('js/_utils.js'), array('jquery'), null, true );
			wp_enqueue_script( 'little_birdies-init', little_birdies_get_file_url('js/_init.js'), array('jquery'), null, true );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (little_birdies_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'little_birdies_localize_scripts' ) ) {
	//Handler of the add_action('wp_footer', 'little_birdies_localize_scripts');
	function little_birdies_localize_scripts() {

		$video = little_birdies_get_header_video();

		wp_localize_script( 'little_birdies-init', 'LITTLE_BIRDIES_STORAGE', apply_filters( 'little_birdies_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', little_birdies_get_theme_option('color_scheme')),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Window width to switch the site header to the mobile layout
			'mobile_layout_width' => 767,
						
			// Sidemenu options
			'menu_side_stretch' => little_birdies_get_theme_option('menu_side_stretch') > 0 ? true : false,
			'menu_side_icons' => little_birdies_get_theme_option('menu_side_icons') > 0 ? true : false,

			// Video background
			'background_video' => little_birdies_is_from_uploads($video) ? $video : '',

			// Video and Audio tag wrapper
			'use_mediaelements' => little_birdies_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'message_maxlength'	=> intval(little_birdies_get_theme_setting('message_maxlength')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'little-birdies'),
					'error_global'		=> esc_html__('Error data validation!', 'little-birdies'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'little-birdies'),
					'name_long'			=> esc_html__('Too long name', 'little-birdies'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'little-birdies'),
					'email_long'		=> esc_html__('Too long email address', 'little-birdies'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'little-birdies'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'little-birdies'),
					'text_long'			=> esc_html__('Too long message text', 'little-birdies')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'little_birdies_wp_scripts_responsive' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'little_birdies_wp_scripts_responsive', 2000);
	function little_birdies_wp_scripts_responsive() {
		wp_enqueue_style( 'little_birdies-responsive', little_birdies_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('little_birdies_wp_head')) {
	//Handler of the add_action('wp_head',	'little_birdies_wp_head', 1);
	function little_birdies_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('little_birdies_add_body_classes') ) {
	//Handler of the add_filter( 'body_class', 'little_birdies_add_body_classes' );
	function little_birdies_add_body_classes( $classes ) {
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'scheme_' . esc_attr(little_birdies_get_theme_option('color_scheme'));

		$blog_mode = little_birdies_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_style_' . esc_attr(little_birdies_get_theme_option('body_style'));

		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(little_birdies_get_theme_option('blog_style'));
			if (little_birdies_storage_get('blog_template') > 0)
				$classes[] = 'blog_template';
		}
        if (little_birdies_get_theme_option("show_page_title") !=1 ) {
            $classes[] = ' hide_elements ';
        }
		if (little_birdies_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(little_birdies_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (little_birdies_is_on(little_birdies_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		
		if (little_birdies_is_on(little_birdies_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(little_birdies_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(little_birdies_get_theme_option("header_position"));

		$menu_style= little_birdies_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load inline styles
if ( !function_exists( 'little_birdies_wp_footer' ) ) {
	//Handler of the add_action('wp_footer', 'little_birdies_wp_footer');
	//and add_action('admin_footer', 'little_birdies_wp_footer');
	function little_birdies_wp_footer() {
		// Get inline styles from storage
		if (($css = little_birdies_storage_get('inline_styles')) != '') {
			wp_enqueue_style(  'little_birdies-inline-styles',  little_birdies_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'little_birdies-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('little_birdies_register_sidebars') ) {
	// Handler of the add_action('widgets_init', 'little_birdies_register_sidebars');
	function little_birdies_register_sidebars() {
		$sidebars = little_birdies_get_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$sb) {
				register_sidebar( array(
										'name'          => $sb['name'],
										'description'   => $sb['description'],
										'id'            => $id,
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( !function_exists('little_birdies_get_sidebars') ) {
	function little_birdies_get_sidebars() {
		$list = apply_filters('little_birdies_filter_list_sidebars', array(
			'sidebar_widgets'		=> array(
											'name' => esc_html__('Sidebar Widgets', 'little-birdies'),
											'description' => esc_html__('Widgets to be shown on the main sidebar', 'little-birdies')
											),
			'header_widgets'		=> array(
											'name' => esc_html__('Header Widgets', 'little-birdies'),
											'description' => esc_html__('Widgets to be shown at the top of the page (in the page header area)', 'little-birdies')
											),
			'above_page_widgets'	=> array(
											'name' => esc_html__('Above Page Widgets', 'little-birdies'),
											'description' => esc_html__('Widgets to be shown below the header, but above the content and sidebar', 'little-birdies')
											),
			'above_content_widgets' => array(
											'name' => esc_html__('Above Content Widgets', 'little-birdies'),
											'description' => esc_html__('Widgets to be shown above the content, near the sidebar', 'little-birdies')
											),
			'below_content_widgets' => array(
											'name' => esc_html__('Below Content Widgets', 'little-birdies'),
											'description' => esc_html__('Widgets to be shown below the content, near the sidebar', 'little-birdies')
											),
			'below_page_widgets' 	=> array(
											'name' => esc_html__('Below Page Widgets', 'little-birdies'),
											'description' => esc_html__('Widgets to be shown below the content and sidebar, but above the footer', 'little-birdies')
											),
			'footer_widgets'		=> array(
											'name' => esc_html__('Footer Widgets', 'little-birdies'),
											'description' => esc_html__('Widgets to be shown at the bottom of the page (in the page footer area)', 'little-birdies')
											)
			)
		);
		$custom_sidebars_number = max(0, min(10, little_birdies_get_theme_setting('custom_sidebars')));
		if (count($custom_sidebars_number) > 0) {
			for ($i=1; $i <= $custom_sidebars_number; $i++) {
				$list['custom_widgets_'.intval($i)] = array(
															'name' => sprintf(esc_html__('Custom Widgets %d', 'little-birdies'), $i),
															'description' => esc_html__('An arbitrary set of widgets. Can be shown in any area of the site', 'little-birdies')
															);
			}
		}
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('little_birdies_theme_fonts_links') ) {
	function little_birdies_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== _x( 'on', 'Google fonts: on or off', 'little-birdies' ) );
		$custom_fonts_enabled = ( 'off' !== _x( 'on', 'Custom fonts (included in the theme): on or off', 'little-birdies' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !little_birdies_storage_empty('load_fonts') ) {
			$load_fonts = little_birdies_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = little_birdies_get_load_fonts_slug($font['name']);
					$url  = little_birdies_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', little_birdies_get_protocol(), $google_fonts, little_birdies_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('little_birdies_theme_fonts_for_editor') ) {
	function little_birdies_theme_fonts_for_editor() {
		$links = array_values(little_birdies_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('little_birdies_excerpt_length') ) {
	function little_birdies_excerpt_length( $length ) {
		return max(1, little_birdies_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('little_birdies_excerpt_more') ) {
	function little_birdies_excerpt_more( $more ) {
		return '&hellip;';
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'little_birdies_importer_set_options' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_importer_options',	'little_birdies_importer_set_options', 9 );
	function little_birdies_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(little_birdies_get_protocol() . '://little-birdies.axiomthemes.com/demo2/');
			// Required plugins
			$options['required_plugins'] = little_birdies_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('BaseKit Demo', 'little-birdies');
			$options['files']['default']['domain_dev'] = esc_url(little_birdies_get_protocol().'://little-birdies.dv.ancorathemes.com');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(little_birdies_get_protocol().'://little-birdies.axiomthemes.com');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			// 		$options['files']['dark_demo'] = $options['files']['default'];
			// 		$options['files']['dark_demo']['title'] = esc_html__('Dark Demo', 'little-birdies');
		}
		return $options;
	}
}



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once trailingslashit( get_template_directory() ) . 'includes/utils.php';
require_once trailingslashit( get_template_directory() ) . 'includes/storage.php';
require_once trailingslashit( get_template_directory() ) . 'includes/lists.php';
require_once trailingslashit( get_template_directory() ) . 'includes/wp.php';

if (is_admin()) {
	require_once trailingslashit( get_template_directory() ) . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/admin.php';
}

require_once trailingslashit( get_template_directory() ) . 'theme-options/theme.customizer.php';

require_once trailingslashit( get_template_directory() ) . 'theme-specific/trx_addons.php';

require_once trailingslashit( get_template_directory() ) . 'includes/theme.tags.php';
require_once trailingslashit( get_template_directory() ) . 'includes/theme.hovers/theme.hovers.php';


// Plugins support
if (is_array($LITTLE_BIRDIES_STORAGE['required_plugins']) && count($LITTLE_BIRDIES_STORAGE['required_plugins']) > 0) {
	foreach ($LITTLE_BIRDIES_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = little_birdies_esc($plugin_slug);
		$plugin_path = trailingslashit( get_template_directory() ) . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}

function little_birdies_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'little_birdies_move_comment_field_to_bottom' );
?>