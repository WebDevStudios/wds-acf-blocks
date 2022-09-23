<?php
/**
 * Render an element.
 *
 * @package abs
 */

namespace WebDevStudios\abs;

/**
 * Render an element.
 *
 * @author WebDevStudios
 *
 * @param string $element_name The name of the block.
 * @param array  $args Args for the block.
 */
function print_element( $element_name = '', $args = [] ) {
	if ( ! $element_name ) {
		return;
	}

	// extract args.
	if ( ! empty( $args ) ) {
		extract( $args ); //phpcs:ignore WordPress.PHP.DontExtract.extract_extract -- We can use it here since we know what to expect on the arguments.
	}

	require ABS_ROOT_PATH . 'src/elements/' . $element_name . '.php';
}
