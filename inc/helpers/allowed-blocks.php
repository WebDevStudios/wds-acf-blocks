<?php
/**
 * Specify which blocks are allowed.
 *
 * @package ABS
 */

namespace WebDevStudios\abs;

/**
 * Specify which blocks are allowed.
 *
 * @author WebDevStudios
 *
 * @param array $abs_allowed_blocks Current list of allowed blocks.
 *
 * @return array Allowed block types.
 */
function allowed_blocks( $abs_allowed_blocks ) {

	// This is meant to overwrite the default set of allowed blocks.
	$abs_allowed_blocks = [
		'core/heading',
		'core/paragraph',
		'core/columns',
		'core/freeform',
		'core/gallery',
		'core/html',
		'core/image',
		'core/list',
		'core/separator',
		'core/spacer',
		'core/table',
	];

	// Add ACF blocks.
	$abs_acf_blocks = acf_get_block_types();

	foreach ( array_keys( $abs_acf_blocks ) as $abs_block_name ) :
		$abs_allowed_blocks[] = $abs_block_name;
	endforeach;

	return $abs_allowed_blocks;
}

// Filter changed at WordPress 5.8.
// See https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#allowed_block_types_all .
$abs_block_filter_name = 'allowed_block_types_all';

add_filter( $abs_block_filter_name, __NAMESPACE__ . '\allowed_blocks', 99 );
