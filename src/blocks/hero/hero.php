<?php
/**
 * BLOCK - Renders a Hero
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package abs
 */

use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\get_block_classes;

$abs_defaults = [
	'class'                => [ 'wds-block', 'hero' ],
	'allowed_innerblocks'  => [ 'core/heading', 'core/paragraph', 'core/buttons', 'core/columns' ],
	'innerblocks_template' => [
			[ 'core/paragraph',
				[
					'placeholder' => 'Eyebrow goes here.',
					'className'   => 'hero-eyebrow',
				],
			],
			[ 'core/heading',
				[
					'level' => 2,
					'placeholder' => 'Title Goes Here',
					'className'   => 'hero-title',
				],
			],
			[ 'core/paragraph',
				[
					'placeholder' => 'Hero content shows up here.',
					'className'   => 'hero-content',
				],
			],
	],
	'id'                   => ! empty( $block['anchor'] ) ? $block['anchor'] : '',
];

// Get custom classes for the block and/or for block colors.
$abs_block_classes = [];
$abs_block_classes = get_block_classes( $block );

if ( ! empty( $abs_block_classes ) ) :
	$abs_defaults['class'] = array_merge( $abs_defaults['class'], $abs_block_classes );
endif;

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class', 'id' ], $abs_defaults );

// Pull in the fields from ACF.
$abs_hero = get_acf_fields( [ 'hero_variation', 'hero_background_style', 'hero_background_image', 'hero_background_color' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/hero-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Hero Block', 'abs' ); ?>"
		>
	</figure>
<?php elseif ( $abs_hero['hero_background_image'] || $abs_hero['hero_background_color']  ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<section class="hero-wrap">
			<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" template="' . esc_attr( wp_json_encode( $abs_defaults['innerblocks_template'] ) ) . '" />'; ?>
			<?php
			print_module(
				'hero',
				[
					'attachment_id' => isset( $abs_hero['hero_background_image'] ) ? $abs_hero['hero_background_image']['id'] : false,
					'overlay'       => false,
					'eyebrow'       => false,
					'heading'       => false,
					'content'       => false,
					'button'        => false,
				],
			);
			?>
		</section>
	</section>
<?php endif; ?>
