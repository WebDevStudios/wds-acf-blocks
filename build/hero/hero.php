<?php
/**
 * BLOCK - Renders a Hero
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package abs
 */

use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\get_block_classes;

// Pull in the fields from ACF.
$abs_hero          = get_acf_fields( [ 'hero_variation', 'hero_background_style', 'hero_background_image', 'hero_background_color' ], $block['id'] );
$abs_hero_bg_color = isset( $abs_hero['hero_background_color'] ) ? 'background-color:' . esc_attr( $abs_hero['hero_background_color'] ) . ';' : '';

$abs_defaults = [
	'class'                => [ 'wds-block', 'hero', $abs_hero['hero_variation'], $abs_hero['hero_background_style'] ],
	'id'                   => ! empty( $block['anchor'] ) ? $block['anchor'] : '',
	'full_height'          => true === $block['full_height'] ? 'min-height:100vh;' : '',
	'allowed_innerblocks'  => [ 'core/heading', 'core/paragraph', 'core/buttons', 'core/spacer' ],
	'innerblocks_template' => [
		[
			'core/paragraph',
			[
				'placeholder' => 'Eyebrow goes here.',
				'className'   => 'hero-eyebrow',
			],
		],
		[
			'core/heading',
			[
				'level'       => 2,
				'placeholder' => 'Title Goes Here',
				'className'   => 'hero-title',
			],
		],
		[
			'core/paragraph',
			[
				'placeholder' => 'Hero content shows up here.',
				'className'   => 'hero-content',
			],
		],
		[
			'core/buttons',
			[
				'core/button',
				[
					'className' => 'hero-button',
				],
			],
		],
	],
];

// Get custom classes for the block and/or for block colors.
$abs_block_classes = [];
$abs_block_classes = get_block_classes( $block );
$abs_inline_styles = 'style=' . $abs_hero_bg_color . $abs_defaults['full_height'];

if ( ! empty( $abs_block_classes ) ) :
	$abs_defaults['class'] = array_merge( $abs_defaults['class'], $abs_block_classes );
endif;

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class', 'id' ], $abs_defaults );

?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/hero-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Hero Block', 'abs' ); ?>"
		>
	</figure>

<?php elseif ( $abs_hero['hero_background_image'] || $abs_hero_bg_color ) : ?>

	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php echo esc_attr( $abs_inline_styles ); ?>>

		<?php
		// Image.
		if ( $abs_hero['hero_background_image'] ) :

			echo '<div class="hero-background">';
				print_element(
					'image',
					[
						'attachment_id' => esc_html( $abs_hero['hero_background_image']['id'] ),
					]
				);
			echo '</div><!-- .background -->';
		endif;
		?>

		<div class="hero-content container">

			<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" template="' . esc_attr( wp_json_encode( $abs_defaults['innerblocks_template'] ) ) . '" />'; ?>

		</div><!-- .hero-content -->

	</section>

<?php endif; ?>
