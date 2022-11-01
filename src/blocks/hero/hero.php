<?php
/**
 * BLOCK - Renders a Hero
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
	'class'               => [ 'wds-block', 'wds-block-hero' ],
	'show_arrows'         => true,
	'show_pagination'     => true,
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];

// Returns updated $abs_defaults array with classes from Gutenberg or from the print_block() function.
// Returns formatted attributes as $abs_atts array.
[ $abs_defaults, $abs_atts ] = setup_block_defaults( $abs_args, $abs_defaults, $abs_block );

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_hero = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( [ 'overlay', 'image', 'heading', 'eyebrow', 'content', 'button_args' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . '../assets/images/block-previews/hero-preview.jpg' ); ?>"
			alt="<?php esc_html_e( 'Preview of the Hero Block', 'abs' ); ?>"
		>
	</figure>
<?php elseif ( $abs_hero['heading'] ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		print_module(
			'hero',
			$abs_hero
		);
		?>
	</section>
<?php endif; ?>
