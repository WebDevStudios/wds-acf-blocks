<?php
/**
 * Hooks and filters.
 *
 * @author Corey Collins
 * @since 1.0
 * @package wds-acf-blocks
 */

namespace WebDevStudios\abs;

/**
 * Specify the location for saving ACF JSON files.
 *
 * @param string $path The path we're saving the files.
 * @return string $path
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_acf_json_save_point( $path ) {

	// Update the path.
	$path = plugin_dir_path( dirname( __FILE__ ) ) . '/acf-json';

	return $path;
}
add_filter( 'acf/settings/save_json', __NAMESPACE__ . '\wds_acf_blocks_acf_json_save_point' );

/**
 * Specify the location for loading ACF JSON files.
 *
 * @param string $paths The paths from which we're loading the files.
 * @return string $paths
 * @author Corey Collins
 * @since 1.0
 */
function wds_acf_blocks_acf_json_load_point( $paths ) {

	// Remove original path (optional).
	unset( $paths[0] );

	// Append the new path.
	$paths[] = plugin_dir_path( dirname( __FILE__ ) ) . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\wds_acf_blocks_acf_json_load_point' );

/**
 * Load block assets only if the block exists on the page.
 *
 * @author WebDevStudios
 * @see https://developer.wordpress.org/reference/hooks/should_load_separate_core_block_assets/
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' );
