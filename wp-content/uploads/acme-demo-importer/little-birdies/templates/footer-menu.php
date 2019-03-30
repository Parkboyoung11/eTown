<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.10
 */

// Footer menu
$little_birdies_menu_footer = little_birdies_get_nav_menu('menu_footer');
if (!empty($little_birdies_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php little_birdies_show_layout($little_birdies_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>