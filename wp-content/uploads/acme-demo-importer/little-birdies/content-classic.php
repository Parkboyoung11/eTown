<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

$little_birdies_blog_style = explode('_', little_birdies_get_theme_option('blog_style'));
$little_birdies_columns = empty($little_birdies_blog_style[1]) ? 2 : max(2, $little_birdies_blog_style[1]);
$little_birdies_expanded = !little_birdies_sidebar_present() && little_birdies_is_on(little_birdies_get_theme_option('expand_content'));
$little_birdies_post_format = get_post_format();
$little_birdies_post_format = empty($little_birdies_post_format) ? 'standard' : str_replace('post-format-', '', $little_birdies_post_format);
$little_birdies_animation = little_birdies_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($little_birdies_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_classic post_layout_classic_'.esc_attr($little_birdies_columns).' post_format_'.esc_attr($little_birdies_post_format) ); ?>
	<?php echo (!little_birdies_is_off($little_birdies_animation) ? ' data-animation="'.esc_attr(little_birdies_get_animation_classes($little_birdies_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	little_birdies_show_post_featured( array( 'thumb_size' => little_birdies_get_thumb_size(
													strpos(little_birdies_get_theme_option('body_style'), 'full')!==false 
														? ( $little_birdies_columns > 2 ? 'big' : 'huge' )
														: (	$little_birdies_columns > 2
															? ($little_birdies_expanded ? 'med' : 'small')
															: ($little_birdies_expanded ? 'big' : 'med')
															)
														)
										) );

	if ( !in_array($little_birdies_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('little_birdies_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('little_birdies_action_before_post_meta'); 

            // Post meta
            little_birdies_show_post_meta(array(
                    'categories' => false,
                    'author' => true,
                    'date' => true,
                    'edit' => false,
                    'seo' => false,
                    'share' => false,
                    'counters' => 'comments'	//comments,likes,views - comma separated in any combination
                )
            );
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$little_birdies_show_learn_more = false; //!in_array($little_birdies_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($little_birdies_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($little_birdies_post_format, array('link', 'aside', 'status', 'quote'))) {
			little_birdies_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $little_birdies_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'little-birdies'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>