<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.06
 */

$little_birdies_header_css = $little_birdies_header_image = '';
$little_birdies_header_video = little_birdies_get_header_video();
if (true || empty($little_birdies_header_video)) {
	$little_birdies_header_image = get_header_image();
	if (little_birdies_is_on(little_birdies_get_theme_option('header_image_override')) && apply_filters('little_birdies_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($little_birdies_cat_img = little_birdies_get_category_image()) != '')
				$little_birdies_header_image = $little_birdies_cat_img;
		} else if (is_singular() || little_birdies_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$little_birdies_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($little_birdies_header_image)) $little_birdies_header_image = $little_birdies_header_image[0];
			} else
				$little_birdies_header_image = '';
		}
	}
}

$little_birdies_header_id = str_replace('header-custom-', '', little_birdies_get_theme_option("header_style"));

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($little_birdies_header_id);
						echo !empty($little_birdies_header_image) || !empty($little_birdies_header_video) ? ' with_bg_image' : ' without_bg_image';
						if ($little_birdies_header_video!='') echo ' with_bg_video';
						if ($little_birdies_header_image!='') echo ' '.esc_attr(little_birdies_add_inline_style('background-image: url('.esc_url($little_birdies_header_image).');'));
						if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
						if (little_birdies_is_on(little_birdies_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(little_birdies_is_inherit(little_birdies_get_theme_option('header_scheme')) 
														? little_birdies_get_theme_option('color_scheme') 
														: little_birdies_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($little_birdies_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('little_birdies_action_show_layout', $little_birdies_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );


		
?></header>