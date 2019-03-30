<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

$little_birdies_blog_style = explode('_', little_birdies_get_theme_option('blog_style'));
$little_birdies_columns = empty($little_birdies_blog_style[1]) ? 2 : max(2, $little_birdies_blog_style[1]);
$little_birdies_post_format = get_post_format();
$little_birdies_post_format = empty($little_birdies_post_format) ? 'standard' : str_replace('post-format-', '', $little_birdies_post_format);
$little_birdies_animation = little_birdies_get_theme_option('blog_animation');
$little_birdies_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($little_birdies_columns).' post_format_'.esc_attr($little_birdies_post_format) ); ?>
	<?php echo (!little_birdies_is_off($little_birdies_animation) ? ' data-animation="'.esc_attr(little_birdies_get_animation_classes($little_birdies_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($little_birdies_image[1]) && !empty($little_birdies_image[2])) echo intval($little_birdies_image[1]) .'x' . intval($little_birdies_image[2]); ?>"
	data-src="<?php if (!empty($little_birdies_image[0])) echo esc_url($little_birdies_image[0]); ?>"
	>

	<?php
	$little_birdies_image_hover = 'icon';	//little_birdies_get_theme_option('image_hover');
	if (in_array($little_birdies_image_hover, array('icons', 'zoom'))) $little_birdies_image_hover = 'dots';
	// Featured image
	little_birdies_show_post_featured(array(
		'hover' => $little_birdies_image_hover,
		'thumb_size' => little_birdies_get_thumb_size( strpos(little_birdies_get_theme_option('body_style'), 'full')!==false || $little_birdies_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. little_birdies_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'little-birdies') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>