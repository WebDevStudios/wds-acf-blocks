<?php
/**
 * MODULE - Figure
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
	'class'         => [ 'wds-module', 'wds-module-figure' ],
	'image_class'   => [],
	'attachment_id' => false,
	'src'           => false,
	'size'          => 'fullsize',
	'loading'       => 'lazy',
	'alt'           => false,
	'show_caption'  => false,
	'caption'       => false,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

if ( $abs_args['show_caption'] && $abs_args['caption'] ) :
	$abs_args['class'][] = 'has-caption';
endif;

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );
?>

<figure <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	print_element(
		'image',
		[
			'attachment_id' => $abs_args['attachment_id'],
			'class'         => $abs_args['image_class'],
			'src'           => $abs_args['src'],
			'size'          => $abs_args['size'],
			'loading'       => $abs_args['loading'],
			'alt'           => $abs_args['alt'],
		]
	);
	?>

	<?php if ( $abs_args['show_caption'] && $abs_args['caption'] ) : ?>
		<figcaption><?php echo esc_html( $abs_args['caption'] ); ?></figcaption>
	<?php endif; ?>
</figure>
