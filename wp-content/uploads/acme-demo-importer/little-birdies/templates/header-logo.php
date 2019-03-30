<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

$little_birdies_args = get_query_var('little_birdies_logo_args');

// Site logo
$little_birdies_logo_image  = little_birdies_get_logo_image(isset($little_birdies_args['type']) ? $little_birdies_args['type'] : '');
$little_birdies_logo_text   = little_birdies_is_on(little_birdies_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$little_birdies_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($little_birdies_logo_image) || !empty($little_birdies_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($little_birdies_logo_image)) {
			$little_birdies_attr = little_birdies_getimagesize($little_birdies_logo_image);
			echo '<img src="'.esc_url($little_birdies_logo_image).'" alt=""'.(!empty($little_birdies_attr[3]) ? sprintf(' %s', $little_birdies_attr[3]) : '').'>' ;
		} else {
			little_birdies_show_layout(little_birdies_prepare_macros($little_birdies_logo_text), '<span class="logo_text">', '</span>');
			little_birdies_show_layout(little_birdies_prepare_macros($little_birdies_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>