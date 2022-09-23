<?php
/**
 * Enqueue scripts and styles.
 *
 * @package abs
 */

namespace WebDevStudios\abs;

/**
 * Enqueue scripts and styles.
 *
 * @author WebDevStudios
 */
function scripts_styles() {

	// Register global plugin styles.
	wp_enqueue_style( 'abs-styles', ABS_ROOT_URL . '/assets/editor-styles.css', [], ABS_WDS_ACF_VERSION );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts_styles' );
