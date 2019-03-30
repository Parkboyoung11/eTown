<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

$little_birdies_sidebar_position = little_birdies_get_theme_option('sidebar_position');
if (little_birdies_sidebar_present()) {
	ob_start();
	$little_birdies_sidebar_name = little_birdies_get_theme_option('sidebar_widgets');
	little_birdies_storage_set('current_sidebar', 'sidebar');
	if ( !dynamic_sidebar($little_birdies_sidebar_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$little_birdies_out = trim(ob_get_contents());
	ob_end_clean();
	if (trim(strip_tags($little_birdies_out)) != '') {
		?>
		<div class="sidebar <?php echo esc_attr($little_birdies_sidebar_position); ?> widget_area<?php if (!little_birdies_is_inherit(little_birdies_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(little_birdies_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'little_birdies_action_before_sidebar' );
				little_birdies_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $little_birdies_out));
				do_action( 'little_birdies_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>