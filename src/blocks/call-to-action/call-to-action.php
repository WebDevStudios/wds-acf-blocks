<?php
/**
 * BLOCK - Renders a Call to Action block
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
	'class'               => [ 'wds-block', 'wds-block-call-to-action' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ( isset( $abs_block ) && ! empty( $abs_block['anchor'] ) ) ? $abs_block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];

// Returns updated $abs_defaults array with classes from Gutenberg or from the print_block() function.
// Returns formatted attriutes as $abs_atts array.
[ $abs_defaults, $abs_atts ] = setup_block_defaults( $abs_args, $abs_defaults, $abs_block );

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_call_to_action = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( [ 'eyebrow', 'heading', 'content', 'button_args', 'layout' ], $abs_block['id'] );
?>

<?php if ( ! empty( $abs_block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/call-to-action-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Call to Action Block', 'abs' ); ?>"
		>
	</figure>
<?php else : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		if ( ! empty( $abs_defaults['allowed_innerblocks'] ) ) :
			echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />';
		endif;

		// Add the grid to the modules.
		$abs_call_to_action['class'][] = 'wds-block-grid';
		print_module( 'call-to-action-' . esc_attr( $abs_call_to_action['layout'] ), $abs_call_to_action );
		?>
	</section>
<?php endif; ?>
