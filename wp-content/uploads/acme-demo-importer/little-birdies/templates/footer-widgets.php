<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.10
 */

// Footer sidebar
$little_birdies_footer_name = little_birdies_get_theme_option('footer_widgets');
$little_birdies_footer_present = !little_birdies_is_off($little_birdies_footer_name) && is_active_sidebar($little_birdies_footer_name);
if ($little_birdies_footer_present) { 
	little_birdies_storage_set('current_sidebar', 'footer');
	$little_birdies_footer_wide = little_birdies_get_theme_option('footer_wide');
	ob_start();
	if ( !dynamic_sidebar($little_birdies_footer_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$little_birdies_out = trim(ob_get_contents());
	ob_end_clean();
	if (trim(strip_tags($little_birdies_out)) != '') {
		$little_birdies_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $little_birdies_out);
		$little_birdies_need_columns = true;	//or check: strpos($little_birdies_out, 'columns_wrap')===false;
		if ($little_birdies_need_columns) {
			$little_birdies_columns = max(0, (int) little_birdies_get_theme_option('footer_columns'));
			if ($little_birdies_columns == 0) $little_birdies_columns = min(6, max(1, substr_count($little_birdies_out, '<aside ')));
			if ($little_birdies_columns > 1)
				$little_birdies_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($little_birdies_columns).' widget ', $little_birdies_out);
			else
				$little_birdies_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($little_birdies_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$little_birdies_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($little_birdies_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'little_birdies_action_before_sidebar' );
				little_birdies_show_layout($little_birdies_out);
				do_action( 'little_birdies_action_after_sidebar' );
				if ($little_birdies_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$little_birdies_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>