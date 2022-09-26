<?php
/**
 * Returns an array of classes from a block's Gutenberg fields.
 *
 * @package abs
 */

namespace WebDevStudios\abs;

/**
 * Returns an updated array of classes.
 *
 * @author WebDevStudios
 *
 * @param array $block Array of block attributes.
 *
 * return array The updated array of classes.
 */
function get_block_classes( $block ) {
	$abs_block_classes = [];

	if ( ! empty( $block['className'] ) ) :
		$abs_block_classes[] = $block['className'];
	endif;

	if ( ! empty( $block['backgroundColor'] ) ) {
		$abs_block_classes[] = 'has-background';
		$abs_block_classes[] = 'has-' . $block['backgroundColor'] . '-background-color';
	}

	if ( ! empty( $block['textColor'] ) ) {
		$abs_block_classes[] = 'has-text-color';
		$abs_block_classes[] = 'has-' . $block['textColor'] . '-color';
	}

	// Get Horizontal Class.
	if ( ! empty( $block['align'] ) ) {
		$abs_block_classes[] = 'align' . $block['align'];
	}

	// Get Vertical Class (Inner Content Align).
	if ( ! empty( $block['alignContent'] ) ) {
		$abs_block_classes[] = 'is-vertically-aligned-' . $block['align_content'];
	}

	// Get Text Align Class.
	if ( ! empty( $block['alignText'] ) ) {
		$abs_block_classes[] = 'has-text-align-' . $block['alignText'];
	}

	// Get Overlay Color Class.
	if ( ! empty( $block['overlayColor'] ) ) {
		$abs_block_classes[] = 'has-' . $block['overlayColor'] . '-background-color';
	}

	return $abs_block_classes;
}
