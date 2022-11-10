<?php
/**
 * MODULE - Breadcrumbs.
 *
 * @link https://developer.wordpress.org/block-editor/
 * @link Accessibility considerations: https://www.aditus.io/patterns/breadcrumbs/
 *
 * @package abs
 */

/**
 * Expected shape of the links array.
 * [
 *  post_ID,
 *  post_ID,
 * ]
 *
 * These will render like:
 * Home / Link 1 / Link 2 / Current Page
 *
 * The home icon will display if 'display_home_icon' is true, otherwise 'Home' will be displayed as text.
 * The current page will display if 'display_current_page' is true.
 */

use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_formatted_args;

$abs_defaults = [
	'class'                => [ 'wds-module', 'wds-module-breadcrumbs' ],
	'display_current_page' => true,
	'display_home_icon'    => true,
	'divider'              => '/', // This should be a UTF-8 icon or text character, such as ▶ (https://utf8-icons.com).
	'links'                => [],
	'aria'                 => [
		'label' => 'breadcrumbs',
	],
];

$abs_args = get_formatted_args( $args, $abs_defaults );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class', 'aria' ], $abs_args );
?>

<nav <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<ol>
		<li>
			<a href="/">
			<?php if ( $abs_args['display_home_icon'] ) : ?>
				<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
					<polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
					<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
					<path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
				</svg>
			<?php else : ?>
				<span class="home-link"><?php esc_html_e( 'Home', 'abs' ); ?></span>
			<?php endif; ?>
			</a>
			<span class="breadcrumbs-divider"><?php echo esc_html( $abs_args['divider'] ); ?></span>
		</li>

		<?php if ( ! empty( $abs_args['links'] ) ) : ?>
			<?php foreach ( $abs_args['links'] as $abs_page_id ) : ?>
				<li>
					<?php
					print_element(
						'button',
						[
							'title' => get_the_title( $abs_page_id ),
							'url'   => get_the_permalink( $abs_page_id ),
						]
					);
					?>
					<?php if ( end( $abs_args['links'] ) !== $abs_page_id ) : ?>
					<span class="breadcrumbs-divider"><?php echo esc_html( $abs_args['divider'] ); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if ( $abs_args['display_current_page'] ) : ?>
			<li>
				<?php if ( ! empty( $abs_args['links'] ) ) : ?>
					<span class="breadcrumbs-divider"><?php echo esc_html( $abs_args['divider'] ); ?></span>
				<?php endif; ?>
				<?php
				print_element(
					'button',
					[
						'title' => get_the_title(),
						'url'   => get_the_permalink(),
						'class' => 'breadcrumbs-current-page',
						'aria'  => [
							'current' => 'page',
						],
					]
				);
				?>
			</li>
		<?php endif; ?>
	</ol>
</nav>
