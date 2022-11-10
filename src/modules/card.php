<?php
/**
 * MODULE - Card.
 *
 * Modules are analagous to 'Molecules' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#molecules
 *
 * @package abs
 */

use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_formatted_args;

$abs_defaults = [
	'class'         => [ 'wds-module', 'wds-module-card' ],
	'eyebrow'       => false,
	'heading'       => false,
	'content'       => false,
	'button'        => false,
	'attachment_id' => false,
	'src'           => false,
	'meta'          => false,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );

?>
<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	// Image.
	if ( $abs_args['attachment_id'] || $abs_args['src'] ) :
		print_element(
			'image',
			[
				'attachment_id' => $abs_args['attachment_id'],
				'src'           => $abs_args['src'],
				'class'         => 'aspectratio-3-2',
			]
		);
	endif;

	// Eyebrow.
	if ( $abs_args['eyebrow'] ) :
		print_element(
			'eyebrow',
			[
				'text' => $abs_args['eyebrow'],
			]
		);
	endif;

	// Heading.
	if ( $abs_args['heading'] ) :
		print_element(
			'heading',
			[
				'text'  => $abs_args['heading'],
				'level' => 2,
			]
		);
	endif;

	// Meta - can be passed as an empty array.
	if ( is_array( $abs_args['meta'] ) ) :
		print_module( 'meta', $abs_args['meta'] );
	endif;

	// Content.
	if ( $abs_args['content'] ) :
		print_element(
			'content',
			[
				'content' => $abs_args['content'],
			]
		);
	endif;

	// Button.
	if ( $abs_args['button'] ) :
		print_element(
			'button',
			$abs_args['button']
		);
	endif;
	?>
</div>
