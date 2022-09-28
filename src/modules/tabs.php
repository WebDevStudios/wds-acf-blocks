<?php
/**
 * MODULE - Tabs
 *
 * @link https://developer.wordpress.org/block-editor/
 *
 * @package abs
 */

use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_formatted_args;

$abs_defaults = [
	'class' => [ 'wds-module', 'wds-module-tabs' ],
	'items' => [],
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );
?>
<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<nav role="tablist">
		<?php foreach ( $abs_args['items'] as $abs_key => $abs_item ) : ?>
			<?php
			print_element(
				'button',
				[
					'class' => [ 'tab-title' ],
					'id'    => 'tab-item-' . $abs_key,
					'title' => $abs_item['text'],
					'role'  => 'tab',
					'aria'  => [
						'controls' => 'tab-content-' . $abs_key,
						'selected' => 0 === $abs_key ? 'true' : 'false',
					],
				]
			);
			?>
		<?php endforeach; ?>
	</nav>

	<div class="tabs-content">
		<?php foreach ( $abs_args['items'] as $abs_key => $abs_item ) : ?>
			<div
				id="tab-content-<?php echo esc_attr( $abs_key ); ?>"
				role="tabpanel"
				aria-labelledby="tab-item-<?php echo esc_attr( $abs_key ); ?>"
				<?php
				if ( 0 !== $abs_key ) {
					echo 'hidden'; }
				?>
			>
				<?php echo esc_html( $abs_item['content'] ); ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
