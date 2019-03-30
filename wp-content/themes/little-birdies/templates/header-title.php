<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

// Page (category, tag, archive, author) title

if ( little_birdies_need_page_title() ) {
	little_birdies_sc_layouts_showed('title', true);
	?>
	<div class="top_panel_title sc_layouts_row">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php

						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$little_birdies_blog_title = little_birdies_get_blog_title();
							$little_birdies_blog_title_text = $little_birdies_blog_title_class = $little_birdies_blog_title_link = $little_birdies_blog_title_link_text = '';
							if (is_array($little_birdies_blog_title)) {
                                $little_birdies_blog_title_text = $little_birdies_blog_title['text'];
								$little_birdies_blog_title_class = !empty($little_birdies_blog_title['class']) ? ' '.$little_birdies_blog_title['class'] : '';
								$little_birdies_blog_title_link = !empty($little_birdies_blog_title['link']) ? $little_birdies_blog_title['link'] : '';
								$little_birdies_blog_title_link_text = !empty($little_birdies_blog_title['link_text']) ? $little_birdies_blog_title['link_text'] : '';
							} else if (little_birdies_exists_woocommerce() && is_product()) {
                                $little_birdies_blog_title_text = esc_html__('Shop Page', 'little-birdies');
                            } else {
                                $little_birdies_blog_title_text = $little_birdies_blog_title;
                            }
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($little_birdies_blog_title_class); ?>"><?php
								$little_birdies_top_icon = little_birdies_get_category_icon();
								if (!empty($little_birdies_top_icon)) {
									$little_birdies_attr = little_birdies_getimagesize($little_birdies_top_icon);
									?><img src="<?php echo esc_url($little_birdies_top_icon); ?>" alt="" <?php if (!empty($little_birdies_attr[3])) little_birdies_show_layout($little_birdies_attr[3]);?>><?php
								}
								echo wp_kses_data($little_birdies_blog_title_text);
							?></h1>
							<?php
							if (!empty($little_birdies_blog_title_link) && !empty($little_birdies_blog_title_link_text)) {
								?><a href="<?php echo esc_url($little_birdies_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($little_birdies_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'little_birdies_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>