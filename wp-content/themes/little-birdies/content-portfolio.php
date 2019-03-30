<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($little_birdies_columns).' post_format_'.esc_attr($little_birdies_post_format) ); ?>
	<?php echo (!little_birdies_is_off($little_birdies_animation) ? ' data-animation="'.esc_attr(little_birdies_get_animation_classes($little_birdies_animation)).'"' : ''); ?>
	>

	<?php
	$little_birdies_image_hover = little_birdies_get_theme_option('image_hover');
	// Featured image
	little_birdies_show_post_featured(array(
		'thumb_size' => little_birdies_get_thumb_size(strpos(little_birdies_get_theme_option('body_style'), 'full')!==false || $little_birdies_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $little_birdies_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $little_birdies_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>