<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

$little_birdies_post_id    = get_the_ID();
$little_birdies_post_date  = little_birdies_get_date();
$little_birdies_post_title = get_the_title();
$little_birdies_post_link  = get_permalink();
$little_birdies_post_author_id   = get_the_author_meta('ID');
$little_birdies_post_author_name = get_the_author_meta('display_name');
$little_birdies_post_author_url  = get_author_posts_url($little_birdies_post_author_id, '');

$little_birdies_args = get_query_var('little_birdies_args_widgets_posts');
$little_birdies_show_date = isset($little_birdies_args['show_date']) ? (int) $little_birdies_args['show_date'] : 1;
$little_birdies_show_image = isset($little_birdies_args['show_image']) ? (int) $little_birdies_args['show_image'] : 1;
$little_birdies_show_author = isset($little_birdies_args['show_author']) ? (int) $little_birdies_args['show_author'] : 1;
$little_birdies_show_counters = isset($little_birdies_args['show_counters']) ? (int) $little_birdies_args['show_counters'] : 1;
$little_birdies_show_categories = isset($little_birdies_args['show_categories']) ? (int) $little_birdies_args['show_categories'] : 1;

$little_birdies_output = little_birdies_storage_get('little_birdies_output_widgets_posts');

$little_birdies_post_counters_output = '';
if ( $little_birdies_show_counters ) {
	$little_birdies_post_counters_output = '<span class="post_info_item post_info_counters">'
								. little_birdies_get_post_counters('comments')
							. '</span>';
}


$little_birdies_output .= '<article class="post_item with_thumb">';

if ($little_birdies_show_image) {
	$little_birdies_post_thumb = get_the_post_thumbnail($little_birdies_post_id, little_birdies_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($little_birdies_post_thumb) $little_birdies_output .= '<div class="post_thumb">' . ($little_birdies_post_link ? '<a href="' . esc_url($little_birdies_post_link) . '">' : '') . ($little_birdies_post_thumb) . ($little_birdies_post_link ? '</a>' : '') . '</div>';
}

$little_birdies_output .= '<div class="post_content">'
			. ($little_birdies_show_categories 
					? '<div class="post_categories">'
						. little_birdies_get_post_categories()
						. $little_birdies_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($little_birdies_post_link ? '<a href="' . esc_url($little_birdies_post_link) . '">' : '') . ($little_birdies_post_title) . ($little_birdies_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('little_birdies_filter_get_post_info', 
								'<div class="post_info">'
									. ($little_birdies_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($little_birdies_post_link ? '<a href="' . esc_url($little_birdies_post_link) . '" class="post_info_date">' : '') 
											. esc_html($little_birdies_post_date) 
											. ($little_birdies_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($little_birdies_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'little-birdies') . ' ' 
											. ($little_birdies_post_link ? '<a href="' . esc_url($little_birdies_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($little_birdies_post_author_name) 
											. ($little_birdies_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$little_birdies_show_categories && $little_birdies_post_counters_output
										? $little_birdies_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
little_birdies_storage_set('little_birdies_output_widgets_posts', $little_birdies_output);
?>