<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.10
 */

// Copyright area
$little_birdies_footer_scheme =  little_birdies_is_inherit(little_birdies_get_theme_option('footer_scheme')) ? little_birdies_get_theme_option('color_scheme') : little_birdies_get_theme_option('footer_scheme');
$little_birdies_copyright_scheme = little_birdies_is_inherit(little_birdies_get_theme_option('copyright_scheme')) ? $little_birdies_footer_scheme : little_birdies_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($little_birdies_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				$little_birdies_copyright = little_birdies_prepare_macros(little_birdies_get_theme_option('copyright'));
				if (!empty($little_birdies_copyright)) {
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $little_birdies_copyright, $little_birdies_matches)) {
						$little_birdies_copyright = str_replace($little_birdies_matches[1], date(str_replace(array('{', '}'), '', $little_birdies_matches[1])), $little_birdies_copyright);
					}
					little_birdies_show_layout(nl2br($little_birdies_copyright));
				}
			?></div>
		</div>
	</div>
</div>
