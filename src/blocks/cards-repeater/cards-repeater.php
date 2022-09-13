<?php
/**
 * BLOCK - Renders 3 card modules
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wd_s
 */

use function WebDevStudios\wd_s\print_module;
use function WebDevStudios\wd_s\get_formatted_atts;
use function WebDevStudios\wd_s\get_acf_fields;
use function WebDevStudios\wd_s\get_block_classes;

$wd_s_defaults = [
	'class'               => [ 'wds-block', 'cards-repeater' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ! empty( $block['anchor'] ) ? $block['anchor'] : '',
];

// Get custom classes for the block and/or for block colors.
$wd_s_block_classes = [];
$wd_s_block_classes = get_block_classes( $block );

if ( ! empty( $wd_s_block_classes ) ) :
	$wd_s_defaults['class'] = array_merge( $wd_s_defaults['class'], $wd_s_block_classes );
endif;

// Set up element attributes.
$wd_s_atts = get_formatted_atts( [ 'class', 'id' ], $wd_s_defaults );

// Pull in the fields from ACF.
$wd_s_cards = get_acf_fields( [ 'card' ], $block['id'] );
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/cards-repeater-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Manual Cards Block', 'wd_s' ); ?>"
		>
	</figure>
<?php elseif ( $wd_s_cards['card'] ) : ?>
	<section <?php echo $wd_s_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $wd_s_defaults['allowed_innerblocks'] ) ) . '" />'; ?>
		<section class="card-wrap">
			<?php
			foreach ( $wd_s_cards['card'] as $wd_s_card ) :
				print_module(
					'card',
					$wd_s_card
				);
			endforeach;
			?>
		</section>
	</section>
<?php endif; ?>
