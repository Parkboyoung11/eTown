<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

// Header sidebar
$little_birdies_header_name = little_birdies_get_theme_option('header_widgets');
$little_birdies_header_present = !little_birdies_is_off($little_birdies_header_name) && is_active_sidebar($little_birdies_header_name);
if ($little_birdies_header_present) { 
	little_birdies_storage_set('current_sidebar', 'header');
	$little_birdies_header_wide = little_birdies_get_theme_option('header_wide');
	ob_start();
	if ( !dynamic_sidebar($little_birdies_header_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$little_birdies_widgets_output = ob_get_contents();
	ob_end_clean();
	if (trim(strip_tags($little_birdies_widgets_output)) != '') {
		$little_birdies_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $little_birdies_widgets_output);
		$little_birdies_need_columns = strpos($little_birdies_widgets_output, 'columns_wrap')===false;
		if ($little_birdies_need_columns) {
			$little_birdies_columns = max(0, (int) little_birdies_get_theme_option('header_columns'));
			if ($little_birdies_columns == 0) $little_birdies_columns = min(6, max(1, substr_count($little_birdies_widgets_output, '<aside ')));
			if ($little_birdies_columns > 1)
				$little_birdies_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($little_birdies_columns).' widget ', $little_birdies_widgets_output);
			else
				$little_birdies_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($little_birdies_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$little_birdies_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($little_birdies_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'little_birdies_action_before_sidebar' );
				little_birdies_show_layout($little_birdies_widgets_output);
				do_action( 'little_birdies_action_after_sidebar' );
				if ($little_birdies_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$little_birdies_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>