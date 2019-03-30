<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.10
 */

$little_birdies_footer_scheme =  little_birdies_is_inherit(little_birdies_get_theme_option('footer_scheme')) ? little_birdies_get_theme_option('color_scheme') : little_birdies_get_theme_option('footer_scheme');
$little_birdies_footer_id = str_replace('footer-custom-', '', little_birdies_get_theme_option("footer_style"));
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($little_birdies_footer_id); ?> scheme_<?php echo esc_attr($little_birdies_footer_scheme); ?>">
	<?php
    // Custom footer's layout
    do_action('little_birdies_action_show_layout', $little_birdies_footer_id);
	?>
</footer><!-- /.footer_wrap -->
