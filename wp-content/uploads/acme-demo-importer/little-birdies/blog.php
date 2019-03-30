<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$little_birdies_content = '';
$little_birdies_blog_archive_mask = '%%CONTENT%%';
$little_birdies_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $little_birdies_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($little_birdies_content = apply_filters('the_content', get_the_content())) != '') {
		if (($little_birdies_pos = strpos($little_birdies_content, $little_birdies_blog_archive_mask)) !== false) {
			$little_birdies_content = preg_replace('/(\<p\>\s*)?'.$little_birdies_blog_archive_mask.'(\s*\<\/p\>)/i', $little_birdies_blog_archive_subst, $little_birdies_content);
		} else
			$little_birdies_content .= $little_birdies_blog_archive_subst;
		$little_birdies_content = explode($little_birdies_blog_archive_mask, $little_birdies_content);
	}
}

// Prepare args for a new query
$little_birdies_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$little_birdies_args = little_birdies_query_add_posts_and_cats($little_birdies_args, '', little_birdies_get_theme_option('post_type'), little_birdies_get_theme_option('parent_cat'));
$little_birdies_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($little_birdies_page_number > 1) {
	$little_birdies_args['paged'] = $little_birdies_page_number;
	$little_birdies_args['ignore_sticky_posts'] = true;
}
$little_birdies_ppp = little_birdies_get_theme_option('posts_per_page');
if ((int) $little_birdies_ppp != 0)
	$little_birdies_args['posts_per_page'] = (int) $little_birdies_ppp;
// Make a new query
query_posts( $little_birdies_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($little_birdies_content) && count($little_birdies_content) == 2) {
	set_query_var('blog_archive_start', $little_birdies_content[0]);
	set_query_var('blog_archive_end', $little_birdies_content[1]);
}

get_template_part('index');
?>