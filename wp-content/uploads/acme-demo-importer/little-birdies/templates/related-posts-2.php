<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

$little_birdies_link = get_permalink();
$little_birdies_post_format = get_post_format();
$little_birdies_post_format = empty($little_birdies_post_format) ? 'standard' : str_replace('post-format-', '', $little_birdies_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($little_birdies_post_format) ); ?>><?php
	little_birdies_show_post_featured(array(
		'thumb_size' => little_birdies_get_thumb_size( 'big' ),
		'show_no_image' => true,
		'singular' => false
		)
	);
	?><div class="post_header entry-header"><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
			?><span class="post_date"><a href="<?php echo esc_url($little_birdies_link); ?>"><?php echo little_birdies_get_date(); ?></a></span><?php
		}
		?>
		<h5 class="post_title entry-title"><a href="<?php echo esc_url($little_birdies_link); ?>"><?php echo the_title(); ?></a></h5>
	</div>
</div>