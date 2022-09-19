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
	'class'        => [ 'wds-module', 'wds-module-cta' ],
	'eyebrow'      => false,
	'heading_args' => false,
	'button'       => false,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );

?>
<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
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
	if ( $abs_args['heading_args'] ) :
		print_element( 'heading', $abs_args['heading_args'] );
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
