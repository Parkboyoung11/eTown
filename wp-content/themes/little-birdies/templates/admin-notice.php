<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0.1
 */
?>
<div class="update-nag" id="little_birdies_admin_notice">
	<h3 class="little_birdies_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'little-birdies'), wp_get_theme()->name); ?></h3>
	<?php
	if (!little_birdies_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'little-birdies')); ?></p><?php
	}
	?><p><?php
		if (little_birdies_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'little-birdies'); ?></a>
			<?php
		}
		if (function_exists('little_birdies_exists_trx_addons') && little_birdies_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'little-birdies'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'little-birdies'); ?></a>
        <a href="#" class="button little_birdies_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'little-birdies'); ?></a>
	</p>
</div>