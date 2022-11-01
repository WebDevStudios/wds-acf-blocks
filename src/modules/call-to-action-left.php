<?php
/**
 * MODULE - Call to Action
 *
 * Modules are analagous to 'Molecules' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#molecules
 *
 * @package abs
 */

use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_formatted_args;

$abs_defaults = [
	'class'       => [ 'wds-module', 'wds-module-call-to-action' ],
	'eyebrow'     => false,
	'heading'     => false,
	'content'     => false,
	'button_args' => false,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );

?>
<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="left-content">
	<?php
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
				'text' => $abs_args['heading'],
			]
		);
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
	?>
	</div>
	<?php
	// Button.
	if ( ! empty( $abs_args['button_args']['button'] ) ) :
		print_element(
			'button',
			$abs_args['button_args']['button']
		);
	endif;
	?>
</div>
