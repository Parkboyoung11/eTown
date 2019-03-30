<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.10
 */


// Socials
if ( little_birdies_is_on(little_birdies_get_theme_option('socials_in_footer')) && ($little_birdies_output = little_birdies_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php little_birdies_show_layout($little_birdies_output); ?>
		</div>
	</div>
	<?php
}
?>