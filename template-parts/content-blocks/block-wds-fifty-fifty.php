<?php
/**
 * The template used for displaying fifty/fifty blocks.
 *
 * @package _s
 */

// Get the block layout field so block template is conditionally loaded.
global $fifty_block, $fifty_alignment, $fifty_classes;
$block_layout    = get_field( 'block_layout' );
$fifty_block     = $block;
$fifty_alignment = wds_acf_gutenberg_get_block_alignment( $fifty_block );
$fifty_classes   = wds_acf_gutenberg_get_block_classes( $fifty_block );

switch ( $block_layout ) {

	case 'text_media':
		include plugin_dir_path( __FILE__ ) . 'block-wds-fifty-text-media.php';
		break;

	case 'media_text':
		include plugin_dir_path( __FILE__ ) . 'block-wds-fifty-media-text.php';
		break;

	case 'text_text':
		include plugin_dir_path( __FILE__ ) . 'block-wds-fifty-text-only.php';
		break;

	default:
		include plugin_dir_path( __FILE__ ) . 'block-wds-fifty-text-media.php';
}


