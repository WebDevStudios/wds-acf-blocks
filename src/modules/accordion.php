<?php
/**
 * MODULE - Accordion
 *
 * @link https://developer.wordpress.org/block-editor/
 *
 * @package abs
 */

use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_args;
use function WebDevStudios\abs\get_formatted_atts;

$abs_defaults = [
	'class' => [ 'wds-module', 'wds-module-accordion' ],
	'items' => [],
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );
?>

<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php foreach ( $abs_args['items'] as $abs_key => $abs_item ) : ?>
		<div class="accordion-item">
			<?php
			print_element(
				'button',
				[
					'class' => [ 'accordion-title' ],
					'id'    => 'accordion-item-' . $abs_key,
					'title' => $abs_item['text'],
					'aria'  => [
						'controls' => 'accordion-content-' . $abs_key,
					],
					'icon'  => [
						'color'  => '#000',
						'icon'   => 'caret-down',
						'height' => '24',
						'width'  => '24',
					],
				]
			);
			?>

			<div
				id="accordion-content-<?php echo esc_attr( $abs_key ); ?>"
				role="region"
				aria-labelledby="accordion-item-<?php echo esc_attr( $abs_key ); ?>"
			>
			<?php
			print_element(
				'content',
				[
					'class'   => [ 'accordion-content' ],
					'content' => $abs_item['content'],
				]
			);
			?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
