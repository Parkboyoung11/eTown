<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

little_birdies_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', little_birdies_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', little_birdies_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', little_birdies_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'little_birdies-gallery-script', little_birdies_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$little_birdies_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$little_birdies_sticky_out = is_array($little_birdies_stickies) && count($little_birdies_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$little_birdies_cat = little_birdies_get_theme_option('parent_cat');
	$little_birdies_post_type = little_birdies_get_theme_option('post_type');
	$little_birdies_taxonomy = little_birdies_get_post_type_taxonomy($little_birdies_post_type);
	$little_birdies_show_filters = little_birdies_get_theme_option('show_filters');
	$little_birdies_tabs = array();
	if (!little_birdies_is_off($little_birdies_show_filters)) {
		$little_birdies_args = array(
			'type'			=> $little_birdies_post_type,
			'child_of'		=> $little_birdies_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $little_birdies_taxonomy,
			'pad_counts'	=> false
		);
		$little_birdies_portfolio_list = get_terms($little_birdies_args);
		if (is_array($little_birdies_portfolio_list) && count($little_birdies_portfolio_list) > 0) {
			$little_birdies_tabs[$little_birdies_cat] = esc_html__('All', 'little-birdies');
			foreach ($little_birdies_portfolio_list as $little_birdies_term) {
				if (isset($little_birdies_term->term_id)) $little_birdies_tabs[$little_birdies_term->term_id] = $little_birdies_term->name;
			}
		}
	}
	if (count($little_birdies_tabs) > 0) {
		$little_birdies_portfolio_filters_ajax = true;
		$little_birdies_portfolio_filters_active = $little_birdies_cat;
		$little_birdies_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters little_birdies_tabs little_birdies_tabs_ajax">
			<ul class="portfolio_titles little_birdies_tabs_titles">
				<?php
				foreach ($little_birdies_tabs as $little_birdies_id=>$little_birdies_title) {
					?><li><a href="<?php echo esc_url(little_birdies_get_hash_link(sprintf('#%s_%s_content', $little_birdies_portfolio_filters_id, $little_birdies_id))); ?>" data-tab="<?php echo esc_attr($little_birdies_id); ?>"><?php echo esc_html($little_birdies_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$little_birdies_ppp = little_birdies_get_theme_option('posts_per_page');
			if (little_birdies_is_inherit($little_birdies_ppp)) $little_birdies_ppp = '';
			foreach ($little_birdies_tabs as $little_birdies_id=>$little_birdies_title) {
				$little_birdies_portfolio_need_content = $little_birdies_id==$little_birdies_portfolio_filters_active || !$little_birdies_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $little_birdies_portfolio_filters_id, $little_birdies_id)); ?>"
					class="portfolio_content little_birdies_tabs_content"
					data-blog-template="<?php echo esc_attr(little_birdies_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(little_birdies_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($little_birdies_ppp); ?>"
					data-post-type="<?php echo esc_attr($little_birdies_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($little_birdies_taxonomy); ?>"
					data-cat="<?php echo esc_attr($little_birdies_id); ?>"
					data-parent-cat="<?php echo esc_attr($little_birdies_cat); ?>"
					data-need-content="<?php echo (false===$little_birdies_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($little_birdies_portfolio_need_content) 
						little_birdies_show_portfolio_posts(array(
							'cat' => $little_birdies_id,
							'parent_cat' => $little_birdies_cat,
							'taxonomy' => $little_birdies_taxonomy,
							'post_type' => $little_birdies_post_type,
							'page' => 1,
							'sticky' => $little_birdies_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		little_birdies_show_portfolio_posts(array(
			'cat' => $little_birdies_cat,
			'parent_cat' => $little_birdies_cat,
			'taxonomy' => $little_birdies_taxonomy,
			'post_type' => $little_birdies_post_type,
			'page' => 1,
			'sticky' => $little_birdies_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>