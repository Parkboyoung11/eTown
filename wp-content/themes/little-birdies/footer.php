<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

						// Widgets area inside page content
						little_birdies_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					little_birdies_create_widgets_area('widgets_below_page');

					$little_birdies_body_style = little_birdies_get_theme_option('body_style');
					if ($little_birdies_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$little_birdies_footer_style = little_birdies_get_theme_option("footer_style");
			if (strpos($little_birdies_footer_style, 'footer-custom-')===0) $little_birdies_footer_style = 'footer-custom';
			get_template_part( "templates/{$little_birdies_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (little_birdies_is_on(little_birdies_get_theme_option('debug_mode')) && file_exists(little_birdies_get_file_dir('images/makeup.jpg'))) { ?>
		<img src="<?php echo esc_url(little_birdies_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>