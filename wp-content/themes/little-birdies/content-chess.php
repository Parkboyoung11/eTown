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
$little_birdies_columns = empty($little_birdies_blog_style[1]) ? 1 : max(1, $little_birdies_blog_style[1]);
$little_birdies_expanded = !little_birdies_sidebar_present() && little_birdies_is_on(little_birdies_get_theme_option('expand_content'));
$little_birdies_post_format = get_post_format();
$little_birdies_post_format = empty($little_birdies_post_format) ? 'standard' : str_replace('post-format-', '', $little_birdies_post_format);
$little_birdies_animation = little_birdies_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($little_birdies_columns).' post_format_'.esc_attr($little_birdies_post_format) ); ?>
	<?php echo (!little_birdies_is_off($little_birdies_animation) ? ' data-animation="'.esc_attr(little_birdies_get_animation_classes($little_birdies_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($little_birdies_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	little_birdies_show_post_featured( array(
											'class' => $little_birdies_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => little_birdies_get_thumb_size(
																	strpos(little_birdies_get_theme_option('body_style'), 'full')!==false
																		? ( $little_birdies_columns > 1 ? 'huge' : 'original' )
																		: (	$little_birdies_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('little_birdies_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('little_birdies_action_before_post_meta'); 

			// Post meta
			$little_birdies_post_meta = little_birdies_show_post_meta(array(
                    'categories' => false,
                    'author' => true,
                    'date' => true,
                    'edit' => false,
                    'seo' => false,
                    'share' => false,
                    'counters' => $little_birdies_columns < 3 ? 'comments' : ''
                )
								);
			little_birdies_show_layout($little_birdies_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$little_birdies_show_learn_more = !in_array($little_birdies_post_format, array('link', 'aside', 'status', 'quote'));
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
				little_birdies_show_layout($little_birdies_post_meta);
			}
			// More button
			if ( $little_birdies_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'little-birdies'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>