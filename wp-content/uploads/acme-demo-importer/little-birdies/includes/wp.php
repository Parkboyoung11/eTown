<?php
/**
 * WP tags and utils
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

// Theme init
if (!function_exists('little_birdies_wp_theme_setup')) {
	add_action( 'after_setup_theme', 'little_birdies_wp_theme_setup' );
	function little_birdies_wp_theme_setup() {

		// Remove macros from title
		add_filter('wp_title',						'little_birdies_wp_title');
		add_filter('wp_title_parts',				'little_birdies_wp_title');
		add_filter('document_title_parts',			'little_birdies_wp_title');

		// Breadcrumbs link 'All posts'
		add_filter('post_type_archive_link',		'little_birdies_get_template_page_link', 10, 2 );
	}
}


/* Blog utilities
-------------------------------------------------------------------------------- */

// Detect current blog mode to get correspond options (post | page | search | blog | home)
if (!function_exists('little_birdies_detect_blog_mode')) {
	function little_birdies_detect_blog_mode() {
		if (is_front_page())
			$mode = 'home';
		else if (is_single())
			$mode = 'post';
		else if (is_page() && !little_birdies_storage_isset('blog_archive'))
			$mode = 'page';
		else
			$mode = 'blog';
		return apply_filters('little_birdies_filter_detect_blog_mode', $mode);
	}
}
	
// Return ID for the page with specified template
if (!function_exists('little_birdies_get_template_page_id')) {
	function little_birdies_get_template_page_id($args=array()) {
		$args = array_merge(array(
			'template' => 'blog.php',
			'post_type' => 'post'
		), $args);
		$q_args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'meta_query' => array('relation' => 'AND')
			);
		if (!empty($args['template'])) {
			$q_args['meta_query'][] = array(
				'key' => '_wp_page_template',
				'value' => $args['template'],
				'compare' => '='
			);
		}
		if (!empty($args['post_type'])) {
			$q_args['meta_query'][] = array(
				'key' => 'little_birdies_options_post_type',
				'value' => $args['post_type'],
				'compare' => '='
			);
		}
		$q_args['meta_query'][] = array(
			'key' => 'little_birdies_options_parent_cat',
			'value' => 1,
			'compare' => '<'
		);
		$id = 0;
		$query = new WP_Query( $q_args );
		while ( $query->have_posts() ) { $query->the_post();
			$id = get_the_ID();
			break;
		}
		wp_reset_postdata();
		return $id;
	}
}

// Return link to the page with theme specific $post_type archive template page:
// page_template == blog.php and 'post_type'== $post_type and 'parent_cat' == 0
if ( !function_exists( 'little_birdies_get_template_page_link' ) ) {
	//Handler of the add_filter('post_type_archive_link', 'little_birdies_get_template_page_link', 10, 2 );
	function little_birdies_get_template_page_link($link='', $post_type='') {
		if (!empty($post_type)) {
			$id = little_birdies_get_template_page_id(array('post_type'=>$post_type));
			if ($id > 0) $link = get_permalink($id);
		}
		return $link;
	}
}


// Return current site protocol
if (!function_exists('little_birdies_get_protocol')) {
	function little_birdies_get_protocol() {
		return is_ssl() ? 'https' : 'http';
	}
}

// Return internal page link - if is customize mode - full url else only hash part
if (!function_exists('little_birdies_get_hash_link')) {
	function little_birdies_get_hash_link($hash) {
		if (strpos($hash, 'http')!==0) {
			if ($hash[0]!='#') $hash = '#'.$hash;
			if (is_customize_preview()) {
				$url = little_birdies_get_current_url();
				if (($pos=strpos($url, '#'))!==false) $url = substr($url, 0, $pos);
				$hash = $url . $hash;
			}
		}
		return $hash;
	}
}

// Return URL to the current page
if (!function_exists('little_birdies_get_current_url')) {
	function little_birdies_get_current_url() {
		global $wp;
		// Attention! We don't need to process it with esc_url() 
		// since this url is being processed with esc_url() where it's used.
		return home_url(add_query_arg(array(), $wp->request));
	}
}

// Remove macros from the title
if ( !function_exists( 'little_birdies_wp_title' ) ) {
	// Handler of the add_filter( 'wp_title', 'little_birdies_wp_title');
	// Handler of the add_filter( 'wp_title_parts', 'little_birdies_wp_title');
	// Handler of the add_filter( 'document_title_parts', 'little_birdies_wp_title');
	function little_birdies_wp_title( $title ) {
		if (is_array($title)) {
			foreach ($title as $k=>$v)
				$title[$k] = little_birdies_remove_macros($v);
		} else
			$title = little_birdies_remove_macros($title);
		return $title;
	}
}

// Return blog title
if (!function_exists('little_birdies_get_blog_title')) {
	function little_birdies_get_blog_title() {

		if (is_front_page())
			$title = esc_html__( 'Home', 'little-birdies' );
		else if ( is_home() )
			$title = esc_html__( 'All Posts', 'little-birdies' );
		else if ( is_author() ) {
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$title = sprintf(esc_html__('Author page: %s', 'little-birdies'), $curauth->display_name);
		} else if ( is_404() )
			$title = esc_html__('URL not found', 'little-birdies');
		else if ( is_search() )
			$title = sprintf( esc_html__( 'Search: %s', 'little-birdies' ), get_search_query() );
		else if ( is_day() )
			$title = sprintf( esc_html__( 'Daily Archives: %s', 'little-birdies' ), get_the_date() );
		else if ( is_month() )
			$title = sprintf( esc_html__( 'Monthly Archives: %s', 'little-birdies' ), get_the_date( 'F Y' ) );
		else if ( is_year() )
			$title = sprintf( esc_html__( 'Yearly Archives: %s', 'little-birdies' ), get_the_date( 'Y' ) );
		 else if ( is_category() )
			$title = sprintf( esc_html__( '%s', 'little-birdies' ), single_cat_title( '', false ) );
		else if ( is_tag() )
			$title = sprintf( esc_html__( 'Tag: %s', 'little-birdies' ), single_tag_title( '', false ) );
		else if ( is_tax() )
			$title = sprintf( esc_html__( '%s', 'little-birdies' ), single_term_title( '', false ) );
		else if ( is_attachment() )
			$title = sprintf( esc_html__( 'Attachment: %s', 'little-birdies' ), get_the_title());
		else if ( is_single() || is_page() )
			$title = get_the_title();
		else
			$title = get_the_title();	//get_bloginfo('name', 'raw');
		return apply_filters('little_birdies_filter_get_blog_title', $title);
	}
}

// Return nav menu html
if ( !function_exists( 'little_birdies_get_nav_menu' ) ) {
	function little_birdies_get_nav_menu($location='', $menu = '', $depth=11, $custom_walker=false) {
		static $list = array();
		if (is_array($location)) { $loc = $location; $location = ''; extract($loc); }
		$slug = $location.'_'.$menu;
		if (empty($list[$slug])) {
			$args = array(
					'menu'				=> empty($menu) || $menu=='default' || little_birdies_is_inherit($menu) ? '' : $menu,
					'container'			=> 'nav',
					'container_class'	=> (!empty($location) ? esc_attr($location) : 'menu_main') . '_nav_area' . (!empty($class) ? ' '.esc_attr($class) : ''),
					'container_id'		=> '',
					'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'menu_class'		=> 'sc_layouts_menu_nav ' . (!empty($location) ? esc_attr($location) : 'menu_main') . '_nav',
					'menu_id'			=> (!empty($location) ? esc_attr($location) : 'menu_main'),
					'echo'				=> false,
					'fallback_cb'		=> '',
					'before'			=> '',
					'after'				=> '',
					'link_before'       => '<span>',
					'link_after'        => '</span>',
					'depth'             => $depth
					);
			if (!empty($location))
				$args['theme_location'] = $location;
			if ($custom_walker && class_exists('little_birdies_custom_menu_walker'))
				$args['walker'] = new little_birdies_custom_menu_walker;
			$list[$slug] = preg_replace(array("/>[\r\n\s]*<li/", "/>[\r\n\s]*<\\/ul>/"),
										array("><li", "></ul>"),
										wp_nav_menu(apply_filters('little_birdies_filter_get_nav_menu_args', $args))
										);
		}
		return apply_filters('little_birdies_filter_get_nav_menu', $list[$slug], $location, $menu);
	}
}

// Return string with categories links
if (!function_exists('little_birdies_get_post_categories')) {
	function little_birdies_get_post_categories($delimiter=', ', $id=false) {
		$output = '';
		$categories = get_the_category($id);
		if ( !empty( $categories ) ) {
			foreach( $categories as $category )
				$output .= ($output ? $delimiter : '') . '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( esc_attr__( 'View all posts in %s', 'little-birdies' ), $category->name ) . '">' . esc_html( $category->name ) . '</a>';
		}
		return $output;
	}
}

// Return string with terms links
if (!function_exists('little_birdies_get_post_terms')) {
	function little_birdies_get_post_terms($delimiter=', ', $id=false, $taxonomy='category') {
		$output = '';
		$terms = get_the_terms($id, $taxonomy);
		if ( !empty( $terms ) ) {
			foreach( $terms as $term )
				$output .= ($output ? $delimiter : '') . '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '" title="' . sprintf( esc_attr__( 'View all posts in %s', 'little-birdies' ), $term->name ) . '">' . esc_html( $term->name ) . '</a>';
		}
		return $output;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'little_birdies_get_post_type_taxonomy' ) ) {
	function little_birdies_get_post_type_taxonomy($post_type) {
		return $post_type == 'post' ? 'category' : apply_filters( 'little_birdies_filter_post_type_taxonomy',	'', $post_type );
	}
}


/* Query manipulations
-------------------------------------------------------------------------------- */

// Add sorting parameter in query arguments
if (!function_exists('little_birdies_query_add_sort_order')) {
	function little_birdies_query_add_sort_order($args, $orderby='date', $order='desc') {
		if (!empty($orderby) && (empty($args['orderby']) || $orderby != 'none')) {
			$q = apply_filters('little_birdies_filter_query_sort_order', array(), $orderby, $order);
			$q['order'] = $order=='asc' ? 'asc' : 'desc';
			if (empty($q['orderby'])) {
				if ($orderby == 'none') {
					$q['orderby'] = 'none';
				} else if ($orderby == 'ID') {
					$q['orderby'] = 'ID';
				} else if ($orderby == 'comments') {
					$q['orderby'] = 'comment_count';
				} else if ($orderby == 'title' || $orderby == 'alpha') {
					$q['orderby'] = 'title';
				} else if ($orderby == 'rand' || $orderby == 'random')  {
					$q['orderby'] = 'rand';
				} else {
					$q['orderby'] = 'post_date';
				}
			}
			foreach ($q as $mk=>$mv) {
				if (is_array($args))
					$args[$mk] = $mv;
				else
					$args->set($mk, $mv);
			}
		}
		return $args;
	}
}

// Add post type and posts list or categories list in query arguments
if (!function_exists('little_birdies_query_add_posts_and_cats')) {
	function little_birdies_query_add_posts_and_cats($args, $ids='', $post_type='', $cat='', $taxonomy='') {
		if (!empty($ids)) {
			$args['post_type'] = empty($args['post_type']) 
									? (empty($post_type) ? array('post', 'page') : $post_type)
									: $args['post_type'];
			$args['post__in'] = explode(',', str_replace(' ', '', $ids));
			if (empty($args['orderby']) || $args['orderby'] == 'none') {
				$args['orderby'] = 'post__in';
				if (isset($args['order'])) unset($args['order']);
			}
		} else {
			$args['post_type'] = empty($args['post_type']) 
									? (empty($post_type) ? 'post' : $post_type)
									: $args['post_type'];
			$post_type = is_array($args['post_type']) ? $args['post_type'][0] : $args['post_type'];
			if (!empty($cat)) {
				$cats = !is_array($cat) ? explode(',', $cat) : $cat;
				if (empty($taxonomy)) 
					$taxonomy = little_birdies_get_post_type_taxonomy($post_type);
				if ($taxonomy == 'category') {				// Add standard categories
					if (is_array($cats) && count($cats) > 1) {
						$cats_ids = array();
						foreach($cats as $c) {
							$c = trim($c);
							if (empty($c)) continue;
							if ((int) $c == 0) {
								$cat_term = get_term_by( 'slug', $c, $taxonomy, OBJECT);
								if ($cat_term) $c = $cat_term->term_id;
							}
							if ($c==0) continue;
							$cats_ids[] = (int) $c;
							$children = get_categories( array(
								'type'                     => $post_type,
								'child_of'                 => $c,
								'hide_empty'               => 0,
								'hierarchical'             => 0,
								'taxonomy'                 => $taxonomy,
								'pad_counts'               => false
							));
							if (is_array($children) && count($children) > 0) {
								foreach($children as $c) {
									if (!in_array((int) $c->term_id, $cats_ids)) $cats_ids[] = (int) $c->term_id;
								}
							}
						}
						if (count($cats_ids) > 0) {
							$args['category__in'] = $cats_ids;
						}
					} else {
						if ((int) $cat > 0) 
							$args['cat'] = (int) $cat;
						else
							$args['category_name'] = $cat;
					}
				} else {									// Add custom taxonomies
					if (!isset($args['tax_query']))
						$args['tax_query'] = array();
					$args['tax_query']['relation'] = 'AND';
					$args['tax_query'][] = array(
						'taxonomy' => $taxonomy,
						'include_children' => true,
						'field'    => (int) $cats[0] > 0 ? 'id' : 'slug',
						'terms'    => $cats
					);
				}
			}
		}
		return $args;
	}
}

// Add filters (meta parameters) in query arguments
if (!function_exists('little_birdies_query_add_filters')) {
	function little_birdies_query_add_filters($args, $filters=false) {
		if (!empty($filters)) {
			if (!is_array($filters)) $filters = array($filters);
			foreach ($filters as $v) {
				$found = false;
				if ($v=='thumbs') {							// Filter with meta_query
					if (!isset($args['meta_query']))
						$args['meta_query'] = array();
					else {
						for ($i=0; $i<count($args['meta_query']); $i++) {
							if ($args['meta_query'][$i]['meta_filter'] == $v) {
								$found = true;
								break;
							}
						}
					}
					if (!$found) {
						$args['meta_query']['relation'] = 'AND';
						if ($v == 'thumbs') {
							$args['meta_query'][] = array(
								'meta_filter' => $v,
								'key' => '_thumbnail_id',
								'value' => false,
								'compare' => '!='
							);
						}
					}
				} else if (in_array($v, array('video', 'audio', 'gallery'))) {			// Filter with tax_query
					if (!isset($args['tax_query']))
						$args['tax_query'] = array();
					else {
						for ($i=0; $i<count($args['tax_query']); $i++) {
							if ($args['tax_query'][$i]['tax_filter'] == $v) {
								$found = true;
								break;
							}
						}
					}
					if (!$found) {
						$args['tax_query']['relation'] = 'AND';
						if ($v == 'video') {
							$args['tax_query'][] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-video' )
							);
						} else if ($v == 'audio') {
							$args['tax_query'] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-audio' )
							);
						} else if ($v == 'gallery') {
							$args['tax_query'] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-gallery' )
							);
						}
					}
				}
			}
		}
		return $args;
	}
}



	
/* Widgets utils
------------------------------------------------------------------------------------- */

// Create widgets area
if (!function_exists('little_birdies_create_widgets_area')) {
	function little_birdies_create_widgets_area($name, $add_classes='') {
		$widgets_name = little_birdies_get_theme_option($name);
		if (!little_birdies_is_off($widgets_name) && is_active_sidebar($widgets_name)) { 
			set_query_var('current_sidebar', $name);
			ob_start();
			if ( !dynamic_sidebar($widgets_name) ) {
				// Put here html if user no set widgets in sidebar
			}
			$out = trim(ob_get_contents());
			ob_end_clean();
			if (trim(strip_tags($out)) != '') {
				$out = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $out);
				$need_columns = strpos($out, 'columns_wrap')===false;
				if ($need_columns) {
					$columns = min(3, max(1, substr_count($out, '<aside ')));
					$out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($columns).' widget ', $out);
				}
				?>
				<div class="<?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?>_wrap widget_area">
					<div class="<?php echo esc_attr($name); ?>_inner <?php echo esc_attr($name); ?>_inner widget_area_inner">
						<?php
						do_action( 'little_birdies_action_before_sidebar' );
						little_birdies_show_layout($out,
										true==$need_columns ? '<div class="columns_wrap">' : '',
                                        true==$need_columns ? '</div>' : ''
                                        );
						do_action( 'little_birdies_action_after_sidebar' );
						?>
					</div> <!-- /.widget_area_inner -->
				</div> <!-- /.widget_area -->
				<?php
			}
		}
	}
}

// Check if sidebar present
if (!function_exists('little_birdies_sidebar_present')) {
	function little_birdies_sidebar_present() {
		global $wp_query;
		$sidebar_name = little_birdies_get_theme_option('sidebar_widgets');
		return apply_filters('little_birdies_filter_sidebar_present', 
					!is_404() 
					&& (!is_search() || $wp_query->found_posts > 0) 
					&& !little_birdies_is_off($sidebar_name) 
					&& is_active_sidebar($sidebar_name)
					);
	}
}



	
/* Inline styles and scripts
------------------------------------------------------------------------------------- */

// Add inline styles and return class for it
if (!function_exists('little_birdies_sidebar_presen')) {
	function little_birdies_add_inline_style($css) {
		$class_name = sprintf('little_birdies_inline_%d', mt_rand());
		little_birdies_storage_concat( 'inline_styles', sprintf('.%s{%s}', $class_name, $css) );
		return $class_name;
	}
}

/* Date & Time
----------------------------------------------------------------------------------------------------- */

// Return post date
if (!function_exists('little_birdies_get_date')) {
	function little_birdies_get_date($dt='', $format='') {
		if ($dt == '') $dt = get_the_time('U');
		if (date('U') - $dt > intval(little_birdies_get_theme_option('time_diff_before'))*24*3600)
			$dt = date_i18n($format=='' ? get_option('date_format') : $format, $dt); 
		else
			$dt = sprintf( esc_html__('%s ago', 'little-birdies'), human_time_diff($dt) );
		return $dt;
	}
}
?>