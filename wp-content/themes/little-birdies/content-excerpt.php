<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

$little_birdies_post_format = get_post_format();
$little_birdies_post_format = empty($little_birdies_post_format) ? 'standard' : str_replace('post-format-', '', $little_birdies_post_format);
$little_birdies_full_content = little_birdies_get_theme_option('blog_content') != 'excerpt' || in_array($little_birdies_post_format, array('link', 'aside', 'status', 'quote'));
$little_birdies_animation = little_birdies_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($little_birdies_post_format) ); ?>
	<?php echo (!little_birdies_is_off($little_birdies_animation) ? ' data-animation="'.esc_attr(little_birdies_get_animation_classes($little_birdies_animation)).'"' : ''); ?>
	><?php

    // Title and post meta
    if (get_the_title() != '') {
        ?>
        <div class="post_header entry-header">
            <?php
            do_action('little_birdies_action_before_post_title');

            // Post title
            the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

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
        </div><!-- .post_header --><?php
    }

	// Featured image
	little_birdies_show_post_featured(array( 'thumb_size' => little_birdies_get_thumb_size( strpos(little_birdies_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));


	
	// Post content
	?><div class="post_content entry-content"><?php
		if ($little_birdies_full_content) {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'little-birdies' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'little-birdies' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$little_birdies_show_learn_more = !in_array($little_birdies_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($little_birdies_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $little_birdies_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'little-birdies'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>