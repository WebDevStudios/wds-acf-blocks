<?php
/**
 * BLOCK - Renders 3 card modules
 *
 * @link https://developer.wordpress.org/block-editor/
 *
 * @package abs
 */

use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\print_module;
use function WebDevStudios\abs\setup_block_defaults;

$abs_block = isset( $block ) ? $block : '';
$abs_args  = isset( $args ) ? $args : '';

$abs_defaults = [
	'class'               => [ 'wds-block', 'wds-block-cards-repeater' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];

// Returns updated $abs_defaults array with classes from Gutenberg or from the print_block() function.
// Returns formatted attributes as $abs_atts array.
[ $abs_defaults, $abs_atts ] = setup_block_defaults( $abs_args, $abs_defaults, $abs_block );

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_cards = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( [ 'card' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'assets/images/block-previews/cards-repeater-preview.jpg' ) ); ?>"
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
