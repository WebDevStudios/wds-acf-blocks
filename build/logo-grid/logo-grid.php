<?php
/**
 * BLOCK - Renders a Logo Grid section
 *
 * @link https://developer.wordpress.org/block-editor/
 *
 * @package abs
 */

use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_block_classes;

$abs_defaults = [
	'class'               => [ 'wds-block', 'logo-grid' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ! empty( $block['anchor'] ) ? $block['anchor'] : '',
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
$abs_logo_grid = get_acf_fields( [ 'logos' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/logo-grid-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Logo Grid Block', 'abs' ); ?>"
		>
	</figure>
<?php elseif ( $abs_logo_grid['logos'] ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<div class="container">
			<?php
			echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />';
			foreach ( $abs_logo_grid['logos'] as $abs_logo ) :
				print_module(
					'figure',
					$abs_logo
				);
			endforeach;
			?>
		</div>
	</section>
<?php endif; ?>
