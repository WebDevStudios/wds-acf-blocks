<?php
/**
 * Plugin Name: WDS ACF Blocks
 * Description: A set of custom Gutenberg blocks built lovingly with Advanced Custom Fields.
 * Author: WebDevStudios
 * Version: 2.0.0
 * Text Domain: abs
 *
 * @package abs
 */

namespace WebDevStudios\abs;

// Define a global version number.
define( 'ABS_WDS_ACF_VERSION', '2.0.0' );
define( 'ABS_ROOT_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'ABS_ROOT_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Check to see if ACF Pro is active.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_has_parent_plugin() {
	if ( is_admin() && current_user_can( 'activate_plugins' ) && ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) || ! is_portable() ) ) {

		// If we try to activate this plugin while the parent plugin isn't active.
		if ( isset( $_GET['activate'] ) && ! wp_verify_nonce( $_GET['activate'] ) ) {
			add_action( 'admin_notices', __NAMESPACE__ . '\wds_acf_blocks_parent_plugin_notice' );
			unset( $_GET['activate'] );
			// If we deactivate the parent plugin while this plugin is still active.
		} elseif ( ! isset( $_GET['activate'] ) ) {
			add_action( 'admin_notices', __NAMESPACE__ . '\wds_acf_blocks_parent_plugin_notice' );
			unset( $_GET['activate'] );
		}

		deactivate_plugins( plugin_basename( __FILE__ ) );

	}
}
add_action( 'admin_init', __NAMESPACE__ . '\wds_acf_blocks_has_parent_plugin' );


/**
 * Provide a notice message if the parent plugin has been deactivated.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_parent_plugin_notice() {
	?>
	<div class="error">
		<p><?php esc_html_e( 'WDS ACF Blocks has been deactivated because Advanced Custom Fields Pro has been deactivated. Advanced Custom Fields Pro must be active in order for you to use WDS ACF Blocks.', 'abs' ); ?></p>
	</div>
	<?php
}


/**
 * Register Blocks
 *
 * @return void
 * @author Jenna Hines
 * @since  2.0.0
 */
function wds_acf_register_blocks() {
	$wds_acf_blocks = glob( plugin_dir_path( __FILE__ ) . 'build/*' );

	foreach ( $wds_acf_blocks as $block ) {
		register_block_type( $block );
	}
}
add_action( 'acf/init', __NAMESPACE__ . '\wds_acf_register_blocks' );

/**
 * Includes helper files
 *
 * @return void
 * @author Biplav Subedi <biplav.subedi@webdevstudios.com>
 * @since  2.0.0
 */
function include_helper_files() {
	$files = [
		'inc/helpers/',
		'wpcli/',
		'inc/',
	];

	foreach ( $files as $include ) {
		$include = trailingslashit( ABS_ROOT_PATH ) . $include;

		// Loop into the directory for php files.
		foreach ( glob( $include . '*.php' ) as $file ) {
			require $file;
		}
	}
}
include_helper_files();
