<?php
/**
 * ELEMENT - Blockquote
 *
 * Elements are analagous to 'Atoms' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#atoms
 *
 * @package abs
 */

use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_formatted_args;

$abs_defaults = [
	'class' => [ 'wds-element', 'wds-element-blockquote' ],
	'id'    => '',
	'cite'  => false,
	'quote' => false,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Make sure element should render.
if ( $abs_args['quote'] ) :

	// Set up element attributes.
	$abs_atts = get_formatted_atts( [ 'class', 'id' ], $abs_args );
	?>
	<blockquote>
		<p><?php echo esc_html( $abs_args['quote'] ); ?></p>
		<cite><?php echo esc_html( $abs_args['cite'] ); ?></cite>
	</blockquote>
<?php endif; ?>
