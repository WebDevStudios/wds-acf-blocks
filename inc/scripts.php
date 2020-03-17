<?php
/**
 * Enqueue scripts and styles.
 *
 * @author Corey Collins
 * @since 1.0
 * @package wds-acf-gutenberg
 */

// Define a global version number.
define( 'WDS_ACF_VERSION', '1.0.0' );

/**
 * Register our scripts and enqueue our main scripts file.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_enqueue_gutenberg_block_scripts() {

	wp_register_script( 'wds-acf-block-js', plugin_dir_url( dirname( __FILE__ ) ) . 'dist/js/app.min.js', array( 'jquery' ), WDS_ACF_VERSION, true );
	wp_register_style( 'slick-carousel', plugin_dir_url( dirname( __FILE__ ) ) . 'node_modules/slick-carousel/slick/slick.css', null, '1.8.1' );
	wp_register_script( 'slick-carousel-js', plugin_dir_url( dirname( __FILE__ ) ) . 'node_modules/slick-carousel/slick/slick.min.js', array( 'jquery', 'wds-acf-block-js' ), '1.8.1', true );

	wp_enqueue_script( 'wds-acf-block-js' );
}

/**
 * Register our styles.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_enqueue_gutenberg_block_styles() {

	wp_register_style( 'wds_acf_gutenberg-style', plugin_dir_url( dirname( __FILE__ ) ) . 'dist/css/style.css', array(), WDS_ACF_VERSION );
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
	wp_enqueue_style( 'slick-carousel' );
	wp_enqueue_script( 'slick-carousel-js' );
}

/**
 * Enqueues styles just for the block preview.
 *
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_block_preview_styles() {

	wp_register_style( 'wds_acf_blocks_editor', plugin_dir_url( dirname( __FILE__ ) ) . 'dist/css/editor.css', array(), WDS_ACF_VERSION );
	wp_enqueue_style( 'wds_acf_blocks_editor' );
}
add_action( 'enqueue_block_editor_assets', 'wds_acf_blocks_block_preview_styles' );