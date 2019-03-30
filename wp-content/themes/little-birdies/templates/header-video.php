<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.14
 */
$little_birdies_header_video = little_birdies_get_header_video();
if (!empty($little_birdies_header_video) && !little_birdies_is_from_uploads($little_birdies_header_video)) {
	global $wp_embed;
	if (is_object($wp_embed))
		$little_birdies_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($little_birdies_header_video) . '[/embed]' ));
	$little_birdies_embed_video = little_birdies_make_video_autoplay($little_birdies_embed_video);
	?><div id="background_video"><?php little_birdies_show_layout($little_birdies_embed_video); ?></div><?php
}
?>