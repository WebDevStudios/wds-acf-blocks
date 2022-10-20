<?php
/**
 * BLOCK - Renders a Call to Action block
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
	'class'               => [ 'wds-block', 'wds-block-call-to-action', 'wds-block-grid' ],
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
$abs_block_classes = isset( $block ) ? get_block_classes( $block ) : '';

if ( ! empty( $abs_block_classes ) ) :
	$abs_defaults['class'] = array_merge( $abs_defaults['class'], $abs_block_classes );
endif;

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_call_to_action = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( [ 'eyebrow', 'heading', 'content', 'button_args', 'layout' ], $block['id'] );

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class', 'id' ], $abs_defaults );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
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

		print_module( 'call-to-action-' . esc_attr( $abs_call_to_action['layout'] ), $abs_call_to_action );
		?>
	</section>
<?php endif; ?>
