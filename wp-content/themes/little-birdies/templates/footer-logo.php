<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.10
 */

// Logo
if (little_birdies_is_on(little_birdies_get_theme_option('logo_in_footer'))) {
	$little_birdies_logo_image = '';
	if (little_birdies_get_retina_multiplier(2) > 1)
		$little_birdies_logo_image = little_birdies_get_theme_option( 'logo_footer_retina' );
	if (empty($little_birdies_logo_image)) 
		$little_birdies_logo_image = little_birdies_get_theme_option( 'logo_footer' );
	$little_birdies_logo_text   = get_bloginfo( 'name' );
	if (!empty($little_birdies_logo_image) || !empty($little_birdies_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($little_birdies_logo_image)) {
					$little_birdies_attr = little_birdies_getimagesize($little_birdies_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($little_birdies_logo_image).'" class="logo_footer_image" alt=""'.(!empty($little_birdies_attr[3]) ? sprintf(' %s', $little_birdies_attr[3]) : '').'></a>' ;
				} else if (!empty($little_birdies_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($little_birdies_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>