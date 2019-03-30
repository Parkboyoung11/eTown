<?php
/**
 * The template to display shortcode's title, subtitle and description
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.08
 */

extract(get_query_var('trx_addons_args_sc_show_titles'));

$align = !empty($args['title_align']) ? ' sc_align_'.trim($args['title_align']) : '';
$style = !empty($args['title_style']) ? ' sc_item_title_style_'.trim($args['title_style']) : '';

if (!empty($args['title'])) {
	if (empty($size)) $size = is_page() ? 'large' : 'normal';
	$title_tag = !empty($args['title_tag']) && !trx_addons_is_off($args['title_tag'])
					? $args['title_tag']
					: apply_filters('trx_addons_filter_sc_item_title_tag', 'large' == $size ? 'h2' : ('tiny' == $size ? 'h3' : 'h2'));
	$title_tag_class = !empty($args['title_tag']) && !trx_addons_is_off($args['title_tag'])
							? ' sc_item_title_tag'
							: '';
	?><<?php echo esc_attr($title_tag); ?> class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_title_class', 'sc_item_title '.$sc.'_title'.$align.$style.$title_tag_class, $sc)); ?>"><?php echo trim(trx_addons_prepare_macros($args['title'])); ?></<?php echo esc_attr($title_tag); ?>><?php
}
if (!empty($args['subtitle'])) {
    ?><h5 class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_subtitle_class', 'sc_item_subtitle '.$sc.'_subtitle'.$align.$style, $sc)); ?>"><?php echo trim(trx_addons_prepare_macros($args['subtitle'])); ?></h5><?php
}
if (!empty($args['description'])) {
	?><div class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_description_class', 'sc_item_descr '.$sc.'_descr'.$align, $sc)); ?>"><?php echo do_shortcode(trx_addons_prepare_macros($args['description'])); ?></div><?php
}
