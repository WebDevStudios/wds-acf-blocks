<?php
/**
 * Returns arrays of defaults for a block.
 *
 * @package abs
 */

namespace WebDevStudios\abs;

use function WebDevStudios\abs\get_block_classes;
use function WebDevStudios\abs\get_formatted_args;
use function WebDevStudios\abs\get_formatted_atts;

/**
 * Returns arrays of Block defaults.
 *
 * @param array  $abs_args Array of arguments from the print_block() function.
 * @param array  $abs_defaults Array of defaults from the block.
 * @param object $abs_block Object containing the block's values.
 *
 * @author Oliver Harrison <oliver.harrison@webdevstudios.com>
 */
function setup_block_defaults( $abs_args = [], $abs_defaults, $abs_block = null ) {
	// Parse the $abs_args if we're rendering this with print_block() from a theme.
	if ( ! empty( $abs_args ) ) :
		$abs_defaults = get_formatted_args( $abs_args, $abs_defaults );
	endif;

	// Get custom classes for the block and/or for block colors.
	$abs_block_classes = isset( $abs_block ) ? get_block_classes( $abs_block ) : [];

	if ( ! empty( $abs_block_classes ) ) :
		$abs_defaults['class'] = array_merge( $abs_defaults['class'], $abs_block_classes );
	endif;

	// Set up element attributes.
	$abs_atts = get_formatted_atts( [ 'class', 'id' ], $abs_defaults );

	return [ $abs_defaults, $abs_atts ];
}
