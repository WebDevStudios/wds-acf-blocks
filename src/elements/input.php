<?php
/**
 * ELEMENT - Input
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
	'class'       => [ 'wds-element', 'wds-element-button' ],
	'type'        => 'text',
	'name'        => '',
	'value'       => '',
	'placeholder' => false,
	'disabled'    => false,
	'required'    => false,
];


$abs_args = get_formatted_args( $args, $abs_defaults );

// Add ID for <label> tags.
if ( $abs_args['name'] ) :
	$abs_args['id'] = $abs_args['name'];
endif;

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'id', 'name', 'placeholder', 'class', 'type', 'disabled', 'required', 'value' ], $abs_args );

?>
<input <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>/>
