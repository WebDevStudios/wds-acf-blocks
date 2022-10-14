<?php
/**
 * Enqueue scripts and styles.
 *
 * @package abs
 */

namespace WebDevStudios\abs;

/**
 * Enqueue admin scripts and styles.
 *
 * @author WebDevStudios
 */
function admin_scripts_styles() {

	// Enqueue global plugin styles for the Admin.
	wp_enqueue_style( 'abs-admin-styles', ABS_ROOT_URL . '/dist/admin.css', [], ABS_WDS_ACF_VERSION );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\admin_scripts_styles' );


/**
 * Enqueue frontend scripts and styles.
 *
 * @author WebDevStudios
 */
function frontend_scripts_styles() {

	// Enqueue global plugin styles for the Frontend.
	wp_enqueue_style( 'abs-fe-styles', ABS_ROOT_URL . '/dist/frontend.css', [], ABS_WDS_ACF_VERSION );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\frontend_scripts_styles' );
