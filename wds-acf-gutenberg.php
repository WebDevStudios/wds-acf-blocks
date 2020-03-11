<?php
/**
 * Plugin Name: WDS ACF Gutenberg
 * Description: A set of custom Gutenberg blocks built lovingly with Advanced Custom Fields.
 * Author: Corey Collins
 * Version: 1.0.0
 * Text Domain: wds-acf-gutenberg
 * Domain Path: /dist/languages/
 *
 * @since 1.0
 * @package wds-acf-gutenberg
 */

/**
 * Check to see if ACF Pro is active.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_gutenberg_has_parent_plugin() {
	if ( is_admin() && current_user_can( 'activate_plugins' ) && ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {

		deactivate_plugins( plugin_basename( __FILE__ ) );

		// If we try to activate this plugin while the parent plugin isn't active.
		if ( isset( $_GET['activate'] ) && ! wp_verify_nonce( $_GET['activate'] ) ) {
			add_action( 'admin_notices', 'wds_acf_gutenberg_child_plugin_notice' );
			unset( $_GET['activate'] );
		// If we deactivate the parent plugin while this plugin is still active.
		} elseif ( ! isset( $_GET['activate'] ) ) {
			add_action( 'admin_notices', 'wds_acf_gutenberg_parent_plugin_notice' );
			unset( $_GET['activate'] );
		}
	}
}
add_action( 'admin_init', 'wds_acf_gutenberg_has_parent_plugin' );

/**
 * Provide a notice message if the parent plugin isn't active when we try to activate this plugin.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_gutenberg_child_plugin_notice() {
	?>
	<div class="error">
		<p><?php esc_html_e( 'Advanced Custom Fields Pro must be active in order for you to use WDS ACF Gutenberg.', 'wds-acf-gutenberg' ); ?></p>
	</div>
	<?php
}

/**
 * Provide a notice message if the parent plugin has been deactivated.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_gutenberg_parent_plugin_notice() {
	?>
	<div class="error">
		<p><?php esc_html_e( 'WDS ACF Gutenberg has been deactivated because Advanced Custom Fields Pro has been deactivated. Advanced Custom Fields Pro must be active in order for you to use WDS ACF Gutenberg.', 'wds-acf-gutenberg' ); ?></p>
	</div>
	<?php
}

// Get our scripts.
require plugin_dir_path( __FILE__ ) . 'inc/scripts.php';

// Get helper functions and template tags.
require plugin_dir_path( __FILE__ ) . 'inc/template-tags.php';

// Get our hooks and filters.
require plugin_dir_path( __FILE__ ) . 'inc/hooks.php';

// Get our queries.
require plugin_dir_path( __FILE__ ) . 'inc/queries.php';
