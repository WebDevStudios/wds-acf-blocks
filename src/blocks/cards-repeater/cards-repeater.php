<?php
/**
 * BLOCK - Renders 3 card modules
 *
 * @link https://developer.wordpress.org/block-editor/
 *
 * @package abs
 */

use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\get_block_classes;
use function WebDevStudios\abs\get_formatted_args;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\print_module;

$abs_defaults = [
	'class'               => [ 'wds-block', 'wds-block-cards-repeater' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];

// Parse the $args if we're rendering this with print_block() from a theme.
if ( ! empty( $args ) ) :
	$abs_defaults = get_formatted_args( $args, $abs_defaults );
endif;

// Get custom classes for the block and/or for block colors.
$abs_block_classes = [];
$abs_block_classes = get_block_classes( $block );

if ( ! empty( $abs_block_classes ) ) :
	$abs_defaults['class'] = array_merge( $abs_defaults['class'], $abs_block_classes );
endif;

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class', 'id' ], $abs_defaults );

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_cards = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( [ 'card' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/cards-repeater-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Manual Cards Block', 'abs' ); ?>"
		>
	</figure>
<?php elseif ( $abs_cards['card'] ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		if ( ! empty( $abs_defaults['allowed_innerblocks'] ) ) :
			echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />';
		endif;
		?>
		<section class="card-wrap">
			<?php
			foreach ( $abs_cards['card'] as $abs_card ) :
				print_module(
					'card',
					$abs_card
				);
			endforeach;
			?>
		</section>
	</section>
<?php endif; ?>
