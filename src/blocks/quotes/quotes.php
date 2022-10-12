<?php
/**
 * BLOCK - Quotes
 *
 * @link https://developer.wordpress.org/block-editor/
 *
 * @package abs
 */

use function WebDevStudios\abs\print_element;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\get_block_classes;

$abs_defaults = [
	'class'               => [ 'wds-block', 'wds-block-quotes' ],
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
$abs_quotes = get_acf_fields( [ 'quotes' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'assets/images/block-previews/quotes-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Quotes Block', 'abs' ); ?>"
		>
	</figure>
<?php elseif ( $abs_quotes['quotes'] ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />'; ?>
		<?php foreach ( $abs_quotes['quotes'] as $abs_quote ) : ?>
			<div class="quote">
				<?php
				print_element(
					'blockquote',
					[
						'quote' => $abs_quote['quote'],
						'cite'  => $abs_quote['cite'],
						'class' => [ 'block-content' ],
					]
				);
				?>
			</div>
		<?php endforeach; ?>
	</section>
<?php endif; ?>
