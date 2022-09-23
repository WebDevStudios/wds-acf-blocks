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

	// Enqueue global plugin styles for the Admin.
	wp_enqueue_style( 'abs-styles', ABS_ROOT_URL . '/assets/editor-styles.css', [], ABS_WDS_ACF_VERSION );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\scripts_styles' );
