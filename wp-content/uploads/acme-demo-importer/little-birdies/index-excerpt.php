<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

little_birdies_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$little_birdies_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$little_birdies_sticky_out = is_array($little_birdies_stickies) && count($little_birdies_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($little_birdies_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($little_birdies_sticky_out && !is_sticky()) {
			$little_birdies_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $little_birdies_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($little_birdies_sticky_out) {
		$little_birdies_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	little_birdies_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>