<?php
/**
 * MODULE - Carousel
 *
 * Modules are analagous to 'Molecules' in Brad Frost's Atomic Design Methodology.
 *
 * @link https://atomicdesign.bradfrost.com/chapter-2/#molecules
 *
 * @package abs
 */

use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_formatted_args;

$abs_defaults = [
	'class'       => [ 'wds-module', 'wds-module-carousel' ],
	'heros'       => [],
	'show_arrows' => true,
];

$abs_args = get_formatted_args( $args, $abs_defaults );

if ( count( $abs_args['heros'] ) ) :

	// Set up element attributes.
	$abs_atts = get_formatted_atts( [ 'class' ], $abs_args );

	wp_enqueue_script( 'abs-smoothscroll', 'https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.js', [], '1.0', true );

	?>
	<div <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

		<div
			tabindex="0"
			role="region"
			aria-labelledby="carousel-label"
		>
			<?php
			if ( $abs_args['show_arrows'] ) :
				print_element(
					'button',
					[
						'class' => [ 'carousel-button' ],
						'icon'  => [
							'icon'   => 'chevron-left',
							'height' => '50px',
							'width'  => '50px',
						],
					]
				);
			endif;
			?>

			<span id="carousel-content-label" class="sr-only" hidden>Carousel</span>

			<ul
				tabindex="0"
				role="listbox"
				aria-labelledby="carousel-content-label"
				class="snap-x snap-mandatory"
			>

				<?php foreach ( $args['heros'] as $abs_hero ) : ?>
					<li class="snap-start" role="option">
						<?php
						print_module(
							'hero',
							$abs_hero
						);
						?>
					</li>
				<?php endforeach; ?>

			</ul>
			<?php
			if ( $abs_args['show_arrows'] ) :
				print_element(
					'button',
					[
						'class' => [ 'carousel-button', 'carousel-button-next' ],
						'icon'  => [
							'icon'   => 'chevron-right',
							'height' => '50px',
							'width'  => '50px',
							'color'  => 'ffffff',
						],
					]
				);
			endif;
			?>
		</div>
	</div>
<?php endif; ?>
