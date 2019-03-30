<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(little_birdies_get_theme_option('color_scheme'));
										 ?>">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'little_birdies_action_before' ); ?>

	<div class="body_wrap">

		<div class="page_wrap">

			<?php
			// Desktop header
			$little_birdies_header_style = little_birdies_get_theme_option("header_style");
			if (strpos($little_birdies_header_style, 'header-custom-')===0) $little_birdies_header_style = 'header-custom';
			get_template_part( "templates/{$little_birdies_header_style}");

			// Side menu
			if (in_array(little_birdies_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( 'templates/header-navi-side' );
			}

			// Mobile header
			get_template_part( 'templates/header-mobile');
			?>

			<div class="page_content_wrap scheme_<?php echo esc_attr(little_birdies_get_theme_option('color_scheme')); ?>">

				<?php if (little_birdies_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					little_birdies_create_widgets_area('widgets_above_page');
					?>				

					<div class="content">
						<?php
						// Widgets area inside page content
						little_birdies_create_widgets_area('widgets_above_content');
						?>				
