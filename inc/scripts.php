<?php
/**
 * Enqueue scripts and styles.
 *
 * @author Corey Collins
 * @since 1.0
 * @package wds-acf-blocks
 */

// Define a global version number.
define( 'WDS_ACF_VERSION', '1.0.0' );

/**
 * Register our scripts and enqueue our main scripts file.
 *
 * @author Corey Collins
 * @since 1.0
 *
 * @return void Bail early if the asset dependency file does not exist.
 */
function wds_acf_enqueue_gutenberg_block_scripts() {

	// Autoload dependencies and version.
	$asset_file_path = plugin_dir_path( dirname( __FILE__ ) ) . 'build/index.asset.php';

	if ( ! file_exists( $asset_file_path ) ) {
		return;
	}

	$asset_file = require $asset_file_path;

	wp_register_script(
		'wds-acf-block-js',
		plugin_dir_url( dirname( __FILE__ ) ) . 'build/index.js',
		$asset_file['dependencies'],
		$asset_file['version'],
		true
	);

	// Register Glider-js style.
	wp_register_style( 'glider-css', plugin_dir_url( dirname( __FILE__ ) ) . 'node_modules/glider-js/glider.min.css', null, '1.7.7' );

	wp_enqueue_script( 'wds-acf-block-js' );
}

/**
 * Register our styles.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_enqueue_gutenberg_block_styles() {

	wp_register_style(
		'wds_acf_gutenberg-style',
		get_stylesheet_directory_uri( dirname( __FILE__ ) ) . '/build/index.css',
		array(),
		WDS_ACF_VERSION
	);

	wp_enqueue_style( 'wds_acf_gutenberg-style' );
}

/**
 * Enqueue frontend scripts and styles.
 *
 * @author WDS
 * @since 1.0
 */
function wds_acf_enqueue_gutenberg_scripts() {

	wds_acf_enqueue_gutenberg_block_scripts();
	wds_acf_enqueue_gutenberg_block_styles();
}
add_action( 'wp_enqueue_scripts', 'wds_acf_enqueue_gutenberg_scripts' );

/**
 * Enqueues a stylesheet for backend block styles.
 *
 * @return void Bail if we're not in the dashboard.
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_acf_enqueue_backend_block_styles() {

	if ( ! is_admin() ) {
		return;
	}

	wds_acf_enqueue_gutenberg_block_scripts();
	wds_acf_enqueue_gutenberg_block_styles();
}

/**
 * Enqueues carousel scripts.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_acf_enqueue_carousel_scripts() {

	wds_acf_blocks_acf_enqueue_backend_block_styles();
	wp_enqueue_style( 'glider-css' );
}

/**
 * Enqueues styles just for the block preview.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_block_preview_styles() {

	wp_register_style(
		'wds_acf_blocks_editor',
		plugin_dir_url( dirname( __FILE__ ) ) . 'build/index.css',
		array(),
		WDS_ACF_VERSION
	);

	wp_enqueue_style( 'wds_acf_blocks_editor' );
}
add_action( 'enqueue_block_editor_assets', 'wds_acf_blocks_block_preview_styles' );
